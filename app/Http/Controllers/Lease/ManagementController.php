<?php

namespace App\Http\Controllers\Lease;

use App\Models\Lease;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ManagementController
 *
 * @package App\Http\Controllers\Lease
 */
class ManagementController extends Controller
{
    /**
     * ManagementController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'forbid-banned-user', 'portal:application']);
    }

    /**
     * Methode voor de overzichts pagina van alle verhuringen.
     *
     * @param  Lease $leases De databank model voor alle verhuringen.
     * @return Renderable
     */
    public function index(Lease $leases): Renderable
    {
        $leases = $leases->paginate();
        return view('lease.index', compact('leases'));
    }

    /**
     * Methode om de gegevens van een verhuring op te halen in de applicatie.
     *
     * @param  Lease $lease De entiteit van de verhuring in de databank opslag.
     * @return Renderable
     */
    public function show(Lease $lease): Renderable
    {
        return view('lease.show', compact('lease'));
    }
}
