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
}
