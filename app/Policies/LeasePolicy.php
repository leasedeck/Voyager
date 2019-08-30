<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lease;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class LeasePolicy
 *
 * @package App\Policies
 */
class LeasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the lease.
     *
     * @param  User  $user  De databank entiteit van de aangemelde gebruiker.
     * @param  Lease $lease De databank entiteit van gegeven verhuring.
     * @return bool
     */
    public function delete(User $user, Lease $lease): bool
    {
        return $user->hasRole('admin') || $lease->verantwoordelijke->is($user);
    }
}
