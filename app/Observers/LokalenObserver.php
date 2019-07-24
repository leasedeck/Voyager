<?php

namespace App\Observers;

use App\Models\Lokalen;
use App\Notifications\Lokalen\Managers\GeneralAttachNotification;
use App\Notifications\Lokalen\Managers\MaintenanceAttachNotification;

/**
 * Class LokalenObserver
 * 
 * @package App\Observers
 */
class LokalenObserver
{
    /**
     * Handle the lokalen "created" event.
     *
     * @param  Lokalen  $lokaal De database entiteit van het aangemaakte lokaal
     * @return void
     */
    public function created(Lokalen $lokaal): void
    {
        $lokaal->verantwoordelijkeAlgemeen->notify(new GeneralAttachNotification($lokaal, auth()->user()));
        $lokaal->verantwoordelijkeOnderhoud->notify(new MaintenanceAttachNotification($lokaal, auth()->user()));
    }
}
