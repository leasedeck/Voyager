<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

/**
 * Class SearchController
 *
 * @package App\Http\Controllers\Users
 */
class SearchController extends Controller
{
    /**
     * Create new IndexController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'role:admin|webmaster', 'forbid-banned-user', 'portal:kiosk']);
    }

    /**
     * Method for searching specific user account in the application.
     *
     * @param  Request $request The request class that holds all the request information.
     * @param  User    $users   The database model for all the users in the application.
     * @return Renderable
     */
    public function index(Request $request, User $users): Renderable
    {
        return view('users.index', [
            'users' => $users->search($request->term)->paginate(), 'requestType' => 'search'
        ]);
    }
}
