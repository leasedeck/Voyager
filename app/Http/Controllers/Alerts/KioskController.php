<?php

namespace App\Http\Controllers\Alerts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alerts\SystemNotificationRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

/**
 * Class KioskController
 *
 * @package App\Http\Controllers\Alerts
 */
class KioskController extends Controller
{
    /**
     * KioskController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'forbid-banned-user', 'role:webmaster', 'portal:kiosk', 'role:webmaster']);
    }

    /**
     * Index method for the system alerts.
     *
     * As index view we have the create view for an new system wide alert message (notification).
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $drivers = ['web' => 'Web notificatie', 'mail' => 'E-mail notificatie'];
        return view('notifications.kiosk.index', compact('drivers'));
    }

    /**
     * Method for sending a system wide notification.
     *
     * @todo Implement and complete validation.
     *
     * @param  SystemNotificationRequest $input The form request class that handles the validation.
     * @return RedirectResponse
     */
    public function store(SystemNotificationRequest $input): RedirectResponse
    {
        return redirect()->route('alerts.index');
    }
}
