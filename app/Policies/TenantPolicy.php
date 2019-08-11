<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TenantPolicy
 *
 * @package App\Policies
 */
class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Methode om te bepalen of de aangemelde gebruiker een huurder kan verwijderen of niet.
     *
     * @param  User $user Databank entiteit van de aangemelde gebruiker.
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']);
    }

    /**
     * Methode om te bepalen of de aangemelde gebruiker de huurder kan wijzigen of niet.
     *
     * @param  User $user Databank entiteit van de aangemelde gebruiker.
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']);
    }

    /**
     * Bepaal of de gebruiker een huurder kan deactiveren or niet.
     *
     * @param  User     $user   Databank entiteit van de aangemelde gebruiker.
     * @param  Tenant   $tenant Databan entiteit van de huurder.
     * @return bool
     */
    public function lock(User $user, Tenant $tenant): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']) && $tenant->isNotBanned();

    }

    /**
     * Bepaal of de aangemlde gebruiker een gedeactiveerde huurder terug kan activeren.
     *
     * @param  User     $user   Databank entiteit van de aangemelde gebruiker.
     * @param  Tenant   $tenant Databank entiteit van de gegeven huurder.
     * @return bool
     */
    public function unlock(User $user, Tenant $tenant): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']) && $tenant->isBanned();
    }
}
