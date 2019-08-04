<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Requests\TenantsFormRequest;
use App\Models\Country;
use App\Models\Tenant;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class TenantController
 *
 * @package App\Http\Controllers\Tenants
 */
class TenantController extends Controller
{
    /**
     * TenantController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'portal:application', 'forbid-banned-user']);
    }

    /**
     * Method om de overzicht weergave van de huurders weer te geven.
     *
     * @param  Tenant  $tenants Database model voor de huurders in d e applicatie.
     * @param  Request $request
     * @return Renderable
     */
    public function index(Tenant $tenants, Request $request): Renderable
    {
        return view('tenants.overview', ['tenants' => $tenants->paginate()]);
    }

    /**
     * Methode voor de creatie weergave van een nieuwe huurder.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('tenants.create', ['countries' => Country::pluck('name', 'id')]);
    }

    /**
     * Methode om een nieuwe huurder op te slaan in het systeem.
     *
     * @param  TenantsFormRequest   $request Form request class dat de validatie regelt.
     * @param  Tenant               $huurder De database model van de huurders
     * @return RedirectResponse
     */
    public function store(TenantsFormRequest $request, Tenant $huurder): RedirectResponse
    {
        dd($request->all());
    }
}