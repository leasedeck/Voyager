<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\AuditLogsExport;
use Illuminate\Contracts\Support\Renderable;
use Spatie\Activitylog\Models\Activity;

/**
 * Class ActivityController
 *
 * @package App\Http\Controllers
 */
class ActivityController extends Controller
{
    /**
     * Create new ActivityController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'role:admin', 'forbid-banned-user']);
        $this->middleware('portal:kiosk')->only(['export', 'index']);
    }

    /**
     * Method for displaying all the audit logs in the application. 
     * 
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('activity.index', ['logs' => Activity::latest()->simplePaginate()]);
    }

    public function export(?string $filter = null) 
    {
        $fileName = now()->format('d-m-Y') . '-audit-logs.xls';
        return (new AuditLogsExport($filter))->download($fileName);
    }

    /**
     * Method to display the logged user operations in the application.
     *
     * @param  User $user   The database entity from the given user.
     * @return Renderable
     */
    public function show(User $user): Renderable
    {
        $activities = $user->actions()->orderBy('created_at', 'DESC')->simplePaginate();
        return view('activity.user', compact('activities', 'user'));
    }
}
