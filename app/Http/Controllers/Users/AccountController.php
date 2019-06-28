<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\InformationValidator;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\TwoFactorAuth\Repository as TwoFactorAuthRepository;

/**
 * Class AccountController
 *
 * @package App\Http\Controllers\Users
 */
class AccountController extends Controller
{
    /**
     * 2FA Repository variable 
     * 
     * @var TwoFactorAuthRepository $twoFactorAuthRepository
     */
    private $twoFactorAuthRepository; 

    /**
     * AccountConstroller constructor
     *
     * @param  TwoFactorAuthRepository $twoFactorAuthRepository 2fa method layer.  
     * @return void
     */
    public function __construct(TwoFactorAuthRepository $twoFactorAuthRepository)
    {
        $this->middleware(['auth', '2fa', 'forbid-banned-user']);
        $this->twoFactorAuthRepository = $twoFactorAuthRepository;
    }

    /**
     * Method for displaying the account settings view. (info)
     *
     * @param  Request $request The instance that holds all the request information.
     * @return Renderable
     */
    public function index(Request $request): Renderable
    { 
        return view('users.settings.information');
    }

    /**
     * Method for displaying the account settings view. (Security)
     * @return Renderable 
     */
    public function indexSecurity(): Renderable 
    {
        $google2faUrl = $this->twoFactorAuthRepository->getGoogle2FaUrl();
        return view('users.settings.security', compact('google2faUrl'));
    }

    /**
     * Method for updating the account information from the authenticated user.
     *
     * @param  InformationValidator $input The form request class that handles the validation.
     * @return RedirectResponse
     */
    public function updateInformation(InformationValidator $input): RedirectResponse
    {
        if (auth()->user()->update($input->all())) { // Update confirmation
            flash('Uw accunt informatie is met success aangepast.')->success()->important();
        }

        return redirect()->back(); // HTTP 302 - Redirect
    }

    /**
     * Method for update the account security from the authenticated used.
     *
     * @param  Request $request The instance that holds all the request information.
     * @param  User    $user    The database model for the login in the application
     * @return RedirectResponse
     */
    public function updateSecurity(Request $request, User $user): RedirectResponse
    {
        $request->validate(['wachtwoord' => ['required', 'string', 'min:8', 'confirmed'], 'huidig_wachtwoord' => ['required', 'string']]);

        // User can only update his account security when the old password is correct.
        if (auth()->user()->securedRequest($request->huidig_wachtwoord)) {
            auth()->logoutOtherDevices($request->huiding_wachtwoord);

            // The password has been updated successfully.
            if (auth()->user()->update(['password' => $request->wachtwoord])) {
                flash('Uw account beveiliging is met success aangepast.')->success()->important();
                return redirect()->back();
            }
        }
        
        flash('Uw huidige wachtwoord komt niet overeen met het gegeven oude wachtwoord!')->error()->important();
        return redirect()->back();
    }
}
