<?php

namespace App\Http\Controllers\Lease;

use App\Models\Lease;
use DebugBar\DataCollector\Renderable;
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
    public function __construct()
    {

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
