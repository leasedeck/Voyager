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
 * @todo Extends Tenant model for supporting bans.
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

        $this->middleware('can:lock,tenant')->only(['create', 'store']);
        $this->middleware('can:unlock,tenant')->only('delete', 'update');
    }

    /**
     * Methode om de deactivatie weergave in de applicatie.
     *
     * @param  Tenant $tenant De databank entiteit van de huurder.
     * @return Renderable
     */
    public function create(Tenant $tenant): Renderable
    {
        // TODO
    }

    /**
     * Methode om de blokkade van de huurder op te slaan in de databank.
     *
     * @param  LockFormRequest  $request De requst instance die e validatie afhandeld en request data bijhoud
     * @param  Tenant           $tenant  De databank entiteit van de huurder.
     * @return RedirectResponse
     */
    public function store(LockFormRequest $request, Tenant $tenant): RedirectResponse
    {
        // TODO
    }

    /**
     * Methode voor de blokkerings weergave van de huurder.
     *
     * @param  Tenant $tenant De databank entiteit van de huurder
     * @return Renderable
     */
    public function delete(Tenant $tenant): Renderable
    {
        // TODO
    }

    /**
     * Methode om de blokkering van de huurder op te slaan in de databank.
     *
     * @param  Tenant $tenant De databnk entiteit van de huurder
     * @return RedirectResponse
     */
    public function update(Tenant $tenant): RedirectResponse
    {
        // TODO
    }
}
