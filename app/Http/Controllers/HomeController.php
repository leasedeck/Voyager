<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

/**
 * Class HomeController
 * ----
 * Controllers that handles the application home pages.
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'forbid-banned-user', 'portal:application'])->only(['index']);
        $this->middleware(['auth', '2fa', 'forbid-banned-user', 'portal:kiosk'])->only(['kiosk']);
        $this->middleware(['guest'])->only(['welcome']);
    }

    /**
     * Get the first page of the application.
     *
     * @return Renderable
     */
    public function welcome(): Renderable
    {
        return view('auth.login');
    }

    /**
     * Method for the dashboard page from the kiosk management.
     *
     * @return Renderable
     */
    public function kiosk(): Renderable
    {
        return view('kiosk');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }
}
