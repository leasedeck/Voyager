<?php

namespace App\Models\Relations;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait HasCreator
 *
 * Relation trait for assigning the creator relation (belongsTo) accross
 * multiple models.
 *
 * @package App\Models\Relations
 */
trait HasCreator
{
    /**
     * Data relation for the creator of the model entity.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Method for storing the creator of the record in the database.
     *
     * @param  User $user The resource entity from the user that u want to attach to the record.
     * @return $this
     */
    public function setCreator(User $user): self
    {
        $this->creator()->associate($user)->save();
        return $this;
    }
}
