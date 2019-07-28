<?php

namespace App\Composers;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class LayoutComposer.
 */
class LayoutComposer
{
    /**
     * The guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * AccountComposer constructor.
     *
     * @param  Guard $auth THe guard implementation variable.
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view The view builder instance.
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('currentUser', $this->auth->user());
        Carbon::setLocale(config('app.locale'));

    }
}
