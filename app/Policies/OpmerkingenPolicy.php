<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class OpmerkingenPolicy
 *
 * @package App\Policies
 */
class OpmerkingenPolicy
{
    use HandlesAuthorization;

    /**
     * Bepaal of de aangemelde gebruiker gemachtigd is om de opemerking te verwijderen.
     *
     * @param  User $user       De databank entiteit van de aangemelde gebruiker
     * @param  Note $opmerking  De databank entiteit van de lokaal notitie (opmerking).
     * @return bool
     */
    public function verwijderOpmerking(User $user, Note $opmerking): bool
    {
        return $user->is($opmerking->creator)
            || $opmerking->lokaal->verantwoordelijke_algemeen === $user->id
            || $user->hasAnyRole(['webmaster']);
    }

    /**
     * Bepaal of dev aangemelde gebruiker een lokaal notitie kan wijzigen of niet.
     *
     * @param  User $user       De databank entiteit van de aangemelde gebruiker.
     * @param  Note $opmerking  De databank entiteit van de lokaal notitie (databank)
     * @return bool
     */
    public function wijzigLokaalOpmerking(User $user, Note $opmerking): bool
    {
        return $user->is($opmerking->creator)
            || $opmerking->lokaal->verantwoordelijke_algemeen === $user->id
            || $user->hasAnyRole(['webmaster']);
    }
}
