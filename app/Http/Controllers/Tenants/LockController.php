<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Requests\Tenants\LockFormRequest;
use App\Models\Tenant;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class LockController
 *
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

        $this->middleware('can:lock,tenant')->only(['create', 'store']);
        $this->middleware('can:unlock,tenant')->only('undo');
    }

    /**
     * Methode om de deactivatie weergave in de applicatie.
     *
     * @see \App\Policies\TenantPolicy::lock()
     *
     * @param  Tenant $tenant De databank entiteit van de huurder.
     * @return Renderable
     */
    public function create(Tenant $tenant): Renderable
    {
        return view('tenants.lock.create', compact('tenant'));
    }

    /**
     * Methode om de blokkade van de huurder op te slaan in de databank.
     *
     * @see \App\Policies\TenantPolicy::lock()
     *
     * @param  LockFormRequest  $request De requst instance die e validatie afhandeld en request data bijhoud
     * @param  Tenant           $tenant  De databank entiteit van de huurder.
     * @return RedirectResponse
     */
    public function store(LockFormRequest $request, Tenant $tenant): RedirectResponse
    {
        try { // Probeer om de huurder te deactiveren
            DB::transaction(static function () use ($request, $tenant): void {
                $tenant->ban($request->all());
                $request->user()->logActivity($tenant, 'Huurders', "Heeft {$tenant->naam} gedeactiveerd als huurder in de applicatie.");
            });

            return redirect()->route('tenants.show', $tenant);
        } catch (Exception $e) { // Woops something went wrong
            flash('Er is intern iets misgelopen bij het deactiveren van de huurder.', 'danger');
            return back(); // Leid de gebruiker terug naar de vorige pagina.
        }
    }

    /**
     * Methode om de blokkering van de huurder ongedaan te maken in de databank.
     *
     * @see \App\Policies\TenantPolicy::unlock()
     *
     * @param Request $request De instantie dat alle request informatie bezit.
     * @param  Tenant  $tenant  De databnk entiteit van de huurder
     * @return RedirectResponse
     */
    public function undo(Request $request, Tenant $tenant): RedirectResponse
    {
        try { // De blokkering van de huurder ongedaan te maken in de applicatie.
            DB::transaction(static function () use ($request, $tenant): void {
                $tenant->unban();

                flash($tenant->naam . 'is terug geactiveerd als huurder in de applicatie.', 'success');
                $request->user()->logActivity($tenant, 'Huurders', "Heeft {$tenant->naam} terug geactiveerd als huurder.");
            });

            return redirect()->route('tenants.show', $tenant);
        } catch (Exception $e) { // Woops! Something went wrong (internally)
            flash('Er is intern iets misgelopen met het activeren van de huurder.', 'danger');
            return back(); // Leid de gebruiker terug naar de vorige pagina.
        }
    }
}
