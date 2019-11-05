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
        $this->middleware(['auth', '2fa', 'forbid-banned-user']);
    }

    /**
     * Methode voor de overzichts pagina van alle verhuringen.
     *
     * @param  Lease $leases De databank model voor alle verhuringen.
     * @return Renderable
     */
    public function index(Lease $leases): Renderable
    {
        return view('lease.index', compact($leases));
    }

    public function show(Lease $lease): Renderable
    {

    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @param  Lease $lease
     * @return Renderable|RedirectResponse
     */
    public function delete(Lease $lease)
    {
        $this->authorize('delete', $lease);
    }
}
