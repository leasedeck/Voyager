<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use App\Repositories\NotificationsRepository;
use Illuminate\Notifications\DatabaseNotification;

/**
 * NotificationController.
 */
class NotificationController extends Controller
{
    /**
     * The dedicated class for all the notifications logic.
     *
     * @var NotificationRepository
     */
    protected $notificationsRepository;

    /**
     * Constructor for the NotificationController class.
     *
     * @param  NotificationsRepository $notificationsRepository
     * @return void
     */
    public function __construct(NotificationsRepository $notificationsRepository)
    {
        $this->middleware(['auth', '2fa', 'forbid-banned-user']);
        $this->notificationsRepository = $notificationsRepository;
    }

    /**
     * Method for displaying the index view for the user his notifications.
     *
     * @param  string|null $type The type of notifications u want to get in the application.
     * @return Renderable
     */
    public function index(?string $type = null): Renderable
    {
        $notificationData = $this->notificationsRepository->getByType($type);
        $viewVariables = ['notifications' => $notificationData['notifications'], 'type' => $notificationData['type']];
        $notificationsCount = [
            'unreadCount' => $this->getAuthenticatedUser()->unreadNotifications()->count(),
            'notificationsCount' => $this->getAuthenticatedUser()->notifications()->count()
        ];

        return view('notifications.index', array_merge($notificationsCount, $viewVariables));
    }

    /**
     * Method for marking the given notification as read.
     *
     * @param  DatabaseNotification $notification The resource entity from the notification.
     * @return RedirectResponse
     */
    public function markOne(DatabaseNotification $notification): RedirectResponse
    {
        $notification->markAsRead();
        return redirect()->route('notifications.index');
    }

    /**
     * Method for marking all the unread notifications from the user as read.
     *
     * @return RedirectResponse
     */
    public function markAll(): RedirectResponse
    {
        $this->notificationsRepository->markAllAsRead();
        return redirect()->route('notifications.index');
    }
}
