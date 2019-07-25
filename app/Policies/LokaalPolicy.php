<?php

namespace App\Policies;

use App\Models\Lokalen;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class LokaalPolicy 
 * 
 * @package App\Policies
 */
class LokaalPolicy
{
    use HandlesAuthorization;

    /**
     * Bepaal of de aangemelde gebruiker een lokaal kan verwijderen of niet. 
     * 
     * @param  User     $user   Re databank entiteit van de aangemelde gebruiker.
     * @param  Lokalen  $lokaal De databank entiteit van het gegeven lokaal
     * @return bool
     */
    public function delete(User $user, Lokalen $lokaal): bool 
    {
        return $user->is($lokaal->verantwoordelijkeAlgemeen)
            || $user->hasAnyRole(['admin', 'webmaster']);
    }

    public function update(User $user, Lokalen $lokaal): bool 
    {
        return false; 
        // return $user->is($lokaal->verantwoordelijkeAlgemeen)
        //    || $user->hasAnyRole(['admin', 'webmaster']);
    }
}
