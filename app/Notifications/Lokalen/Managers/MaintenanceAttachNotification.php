<?php

namespace App\Notifications\Lokalen\Managers;

use App\Models\Lokalen;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class MaintenanceNotification
 * 
 * @package App\Notifications\Lokalen\Managers
 */
class MaintenanceAttachNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var Lokalen */
    public $lokaal;
    
    /** @var User $user */
    public $creator;
    
    /**
     * Create a new notification instance.
     *
     * @param  Lokalen  $lokaal     De variable voor het gegeven lokaal.
     * @param  User     $creator    De data van de aangemelde gebruiker.
     * @return void
     */
    public function __construct(Lokalen $lokaal, User $creator)
    {
        $this->creator = $creator;
        $this->lokaal = $lokaal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'sender'        => $this->creator,
            'title'         => 'Aangewezen als technisch verantwoordelijke',
            'message'       => "Je bent aangewezen als technisch verantwoordelijke voor een lokaal. ({$this->lokaal->naam})",
            'action_url'    => route('lokalen.show', $this->lokaal),
            'action_text'   => 'bekijk lokaal',
        ];
    }
}
