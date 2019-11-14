<?php

namespace App\Http\Controllers\Users;

use Gate;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\LoginCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Users\InformationValidator;
use Spatie\Permission\Models\Role;

/**
 * Class IndexController.
 */
class IndexController extends Controller
{
    /**
     * Create new IndexController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'role:admin|webmaster', 'forbid-banned-user', 'portal:kiosk']);
        $this->middleware('password.confirm')->only('destroy');
    }

    /**
     * Method to display all the users in the application.
     *
     * @param  Request      $request The request instance that holds all the information about the request.
     * @param  User         $users   The database model builder for the application users
     * @return Renderable
     */
    public function index(Request $request, User $users): Renderable
    {
        switch ($request->filter) {
            case 'actief':        $users = $users->withoutBanned(); break;
            case 'gedeactiveerd': $users = $users->onlyBanned();    break;
        }

        $requestType = $request->filter;
        return view('users.index', ['users' => $users->paginate(), 'requestType' => $requestType]);
    }

    /**
     * Method for displaying the user information in the application.
     *
     * @param  User $user The database entity for the given user.
     * @return Renderable
     */
    public function show(User $user): Renderable
    {
        $roles = Role::all(['name']);

        return view('users.show', compact('user', 'roles'));
    }

    /**
     * Method for displaying the create view for an new user.
     *
     * @param  Role $roles The database resource model for the application roles.
     * @return Renderable
     */
    public function create(Role $roles): Renderable
    {
        $roles = $roles->pluck('name', 'name');
        return view('users.create', compact('roles'));
    }

    /**
     * Method for storing the new user in the application.
     *
     * @param  InformationValidator $input The form request class that handles the input validation.
     * @return RedirectResponse
     */
    public function store(InformationValidator $input): RedirectResponse
    {
        $input->merge(['password' => Str::random(16)]);

        $user = DB::transaction(static function () use ($input): User {
            $user = User::create($input->all());
            $user->syncRoles($input->role);

            $user->notify((new LoginCreated($input->all()))->delay(now()->addMinute()));
            (new Controller)->getAuthenticatedUser()->logActivity($user, 'Gebruikers', "Heeft een login aangemaakt voor {$user->name}");

            return $user;
        });

        return redirect()->route('users.show', $user);
    }

    /**
     * Method for updating the user in the application.
     *
     * @param  InformationValidator $input  The form request class that handles the validation.
     * @param  User                 $user   The database entity form the given user.
     * @return RedirectResponse
     */
    public function update(InformationValidator $input, User $user): RedirectResponse
    {
        if ($user->update($input->all())) {
            $user->syncRoles($input->roles);

            if ($user->isNot($this->getAuthenticatedUser())) {
                $this->getAuthenticatedUser()->logActivity($user, 'Gebruikers', "Heeft de account gegevens van {$user->name} gewijzigd.");
            }

            flash("De gegevens van {$user->name} zijn aangepast in de applicatie")->success();
        }

        return redirect()->route('users.show', $user);
    }

    /**
     * Method for deleting the account in the application.
     *
     * @throws \Exception When we can't perform the user delete.
     *
     * @param  Request $request The request entity that holds all the request information.
     * @param  User    $user    The database entity from the given user.
     * @return View|RedirectResponse
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->isMethod('GET')) { // (1)
            return view('users.delete', compact('user'));
        }

        // Delete the actual user in the application.
        $user->delete();

        if (Gate::denies('same-user')) { // (3)
            $this->getAuthenticatedUser()->logActivity($user, 'Gebruikers', "Heeft de gebruiker {$user->name} verwijderd in de applicatie.");
        }

        flash("De gebruiker {$user->name} is verwijderd in de applicatie.")->success()->important();
        return redirect()->route('users.index');
    }
}
