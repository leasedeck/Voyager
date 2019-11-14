<?php

namespace App\Http\Controllers\Tenants;

use Exception;
use ActivismeBe\ValidationRules\Rules\MatchUserPassword;
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
        $this->middleware('password.confirm')->only('destroy');
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
     * @todo Implementatie update methode om de info aan te passen.
     *
     * @param  Tenant $huurder De databank entiteit van de huurder
     * @return Renderable
     */
    public function show(Tenant $huurder): Renderable
    {
        $canEdit = $this->getAuthenticatedUser()->can('update', $huurder);
        $countries = Country::all(['id', 'name']);
        $banInfo = $huurder->bans()->latest()->first();

        return view('tenants.show', compact('canEdit', 'huurder', 'countries', 'banInfo'));
    }

    /**
     * Methode om een huurder te verwijderen uit de applicatie.
     *
     * @param  Request $request De instantie dat de data bijhoud van de request.
     * @param  Tenant  $tenant  De databank entiteit van de huurder.
     * @return Renderable|RedirectResponse
     */
    public function destroy(Request $request, Tenant $tenant)
    {
        if ($request->isMethod('GET')) {
            return view('tenants.delete', compact('tenant'));
        }

        try { // To delete the tenant in the application.
            DB::transaction(static function () use ($tenant, $request): void {
                $tenant->delete();
                $request->user()->logActivity($tenant, 'Huurders', "Heeft {$tenant->naam} verwijderd als huurder in de applicatie.");

                if (Tenant::count() > 0) {
                    flash(ucfirst($tenant->naam) . 'Is verwijderd als huur der in de applicatie');
                }
            });
        } catch (Exception $exception) { // Woops! Something went wrong
            flash('Er is iets misgelopen bij het verwijderen van de huurder')->important();
        }

        return redirect()->route('tenants.overview');
    }
}
