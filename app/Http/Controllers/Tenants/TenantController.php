<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use Illuminate\Contracts\Support\Renderable;
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
}
