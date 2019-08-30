<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Requests\Tenants\LeaseFormRequest;
use App\Models\Lease;
use App\Models\Tags;
use App\Models\Tenant;
use App\Repositories\LeaseRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * Class LeaseController
 *
 * @package App\Http\Controllers\Tenants
 */
class LeaseController extends Controller
{
    /** @var LeaseRepository $leaseRepository The variable for the abstraction layer for the lease DB methods. */
    protected $leaseRepository;

    /**
     * LeaseController constructor.
     *
     * @param  LeaseRepository $leaseRepository The abstraction layer for the lease DB methods.
     * @return void
     */
    public function __construct(LeaseRepository $leaseRepository)
    {
        $this->leaseRepository = $leaseRepository;
        $this->middleware(['auth', '2fa', 'portal:application', 'forbid-banned-user']);
    }

    /**
     * Methode foor het weergeven van de verhuringen voor de gegeven huurder.
     *
     * @param  Tenant $tenant De databank entiteit van de gegeven huurder.
     * @return Renderable
     */
    public function index(Tenant $tenant): Renderable
    {
        $leases = $tenant->verhuringen()->latest()->paginate();
        return view('lease.tenants.overview', compact('tenant', 'leases'));
    }

    /**
     * Methode voor de creatie weergave van een verhuring voor de gegeven huurder.
     *
     * @param Tenant $tenant De Databank entiteit van de gegeven huurder.
     * @return Renderable|RedirectResponse
     */
    public function create(Tenant $tenant)
    {
        if ($tenant->isNotBanned()) {
            $tags = $this->leaseRepository->getStatusses();
            return view('lease.tenants.create', compact('tenant', 'tags'));
        }

        // ELSE De huurder is gedeactiveerd in de applicatie.
        flash($tenant->naam . 'is gedeactiveerd waardoor er geen verhuring kan aangemaakt worden.', 'danger');
        return back(); // Stuur de gebruiker terug naar de vorige pagina.
    }

    /**
     * Methode om een verhuring van de gegeven huurder toe te voegen.
     *
     * @param  LeaseFormRequest $input  De request class voor de validatie.
     * @param  Tenant           $tenant Databank entiteit van de gegeven huurder.
     * @return Renderable
     */
    public function store(LeaseFormRequest $input, Tenant $tenant): Renderable
    {
        DB::transaction(static function () use ($input, $tenant): void {
            $lease = new Lease($input->all());

            $tenant->verhuringen()->save($lease);
        });
    }
}
