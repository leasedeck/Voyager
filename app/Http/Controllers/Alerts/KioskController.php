<?php

namespace App\Http\Controllers\Alerts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alerts\SystemNotificationRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use App\Repositories\NotificationsRepository;

/**
 * Class KioskController
 *
 * @package App\Http\Controllers\Alerts
 */
class KioskController extends Controller
{
    /**
     * Variable for the notification layer in the application. 
     * 
     * @var NotificationsRepository $notifications
     */
    protected $notifications; 

    /**
     * KioskController constructor.
     *
     * @param  NotificationsRepository $notifications Implementation of the layer.
     * @return void
     */
    public function __construct(NotificationsRepository $notifications)
    {
        $this->notifications = $notifications;
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
        $drivers = ['database' => 'Web notificatie', 'mail' => 'E-mail notificatie'];
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
        if ($this->notifications->sendSystemAlert($input)) {
            flash('De systeem notificatie is opgeslagen en zal ASAP worden verzonden.', 'success');
        }

        return redirect()->route('alerts.index');
    }
}
