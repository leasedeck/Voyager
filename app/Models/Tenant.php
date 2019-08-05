<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Data relatie voor de verhuringen van de huurder.
     *
     * @return HasMany
     */
    public function verhuringen(): HasMany
    {
        return $this->hasMany(Lease::class, 'huurder_id');
    }

    /**
     * Methode om de volledige naam samen te stellen op basis van data.
     *
     * @return string
     */
    public function getNaamAttribute(): string
    {
        return ucfirst($this->voornaam) . ' ' . ucfirst($this->achternaam);
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
