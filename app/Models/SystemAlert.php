<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemAlert.
 */
class SystemAlert extends Model
{
    /**
     * The guarded mass-assignment fields for the database table.
     *
     * @return array
     */
    protected $guarded = ['id'];

    /**
     * Method for getting the information about who sended the notification.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault(['name' => config('app.name')]);
    }
}
