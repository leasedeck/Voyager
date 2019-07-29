<?php

namespace App\Providers;

use App\Models\Note;
use App\Models\User;
use App\Models\Contact;
use App\Policies\OpmerkingenPolicy;
use App\Policies\UserPolicy;
use App\Policies\LokaalPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\ContactPolicy;
use App\Models\Lokalen;

/**
 * Class AuthServiceProvider.
 *
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Contact::class => ContactPolicy::class,
        Lokalen::class => LokaalPolicy::class,
        Note::class => OpmerkingenPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
