<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Requests\Tenants\LockFormRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class LockController
 *
 * @todo Register policies (lock, unlock)
 * @todo Complete validator
 * @todo Register routes
 * @todo Write controller logic
 *
 * @package App\Http\Controllers\Tenants
 */
class LockController extends Controller
{
    /**
     * LockController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'portal:application', 'forbid-banned-user']);
    }

    public function create(Tenant $tenant): Renderable
    {
        // TODO
    }

    public function store(LockFormRequest $request, Tenant $tenant): RedirectResponse
    {
        $this->authorize('lock', $tenant);
    }

    public function delete(Tenant $tenant): Renderable
    {
        // TODO
    }

    public function update(Tenant $tenant): RedirectResponse
    {
        $this->authorize('unlock', $tenant);
    }
}
