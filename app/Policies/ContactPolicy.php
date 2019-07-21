<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ContactPolicy 
 * 
 * @package App\Policies
 */
class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the contact.
     *
     * @param  User     $user       The resource entity from the authenticated user. 
     * @param  Contact  $contact    The resource entity from the contact person. 
     * @return bool
     */
    public function delete(User $user, Contact $contact): bool 
    {
        return $user->is($contact->creator) || $user->hasAnyRole(['admin', 'webmaster']);
    }

    /**
     * Determine whether the user can edit the contact. 
     * 
     * @param  User     $user       The resource entity from the authenticated user. 
     * @param  Contact  $contact    The resource entity from the contact person.
     * @return bool
     */
    public function edit(User $user, Contact $contact): bool 
    {
        return $user->is($contact->creator) || $user->hasAnyRole(['admin', 'webmaster']);
    }
}
