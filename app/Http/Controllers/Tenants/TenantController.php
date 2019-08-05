<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Requests\TenantsFormRequest;
use App\Models\Country;
use App\Models\Tenant;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        return view('tenants.overview', ['tenants' => $tenants->withCount('verhuringen')->paginate()]);
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
        DB::transaction(static function () use ($request, $huurder): Tenant {
            $huurder = $huurder->create($request->except('land_id'))->setCountry($request->land_id);
            flash($huurder->name . 'Is toegevoegd als huurder in de applicatie');

            return $huurder;
        });

        return redirect()->route('tenants.show', $huurder);
    }

    /**
     * Methode om de informatie van een huurder weer te geven.
     *
     * @param  Tenant $huurder De databank entiteit van de huurder
     * @return Renderable
     */
    public function show(Tenant $huurder): Renderable
    {
        $canEdit = $this->getAuthenticatedUser()->can('update', $huurder);
        $countries = Country::all(['id', 'name']);

        return view('tenants.show', compact('canEdit', 'huurder', 'countries'));
    }
}
