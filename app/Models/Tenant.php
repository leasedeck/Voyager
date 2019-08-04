<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Tenant
 *
 * @package App\Models
 */
class Tenant extends Model
{
    /**
     * The guarded fields for the internal mass-assignment system?
     *
     * @var array
     */
    protected $guarded = ['id', 'land_id'];

    /**
     * Data relatie omtrent het land van de huurder.
     *
     * @return BelongsTo
     */
    public function land(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Methode om de data relatie voor de huurder zijn land te registreren.
     *
     * @param  int $country De unieke waarde van het land in de applicatie.
     * @return Tenant
     */
    public function setCountry(int $country): self
    {
        $this->land()->associate($country)->save();
        return $this;
    }
}
