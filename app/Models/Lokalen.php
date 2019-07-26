<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Lokalen 
 * 
 * @package App\Models
 */
class Lokalen extends Model
{
    /**
     * The quarded fields for the database model table. 
     * 
     * @return array
     */
    protected $guarded = ['id'];

    /**
     * Data relatie voor de persoon die verantwoordelijk is voor het lokaal. (algemeen)
     * 
     * @return BelongsTo
     */
    public function verantwoordelijkeAlgemeen(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'verantwoordelijke_algemeen');
    }

    /**
     * Methode voor de opmerkingen database relatie in voyager. 
     * 
     * @return MorphMany
     */
    public function opmerkingen(): MorphMany
    {
        return $this->morphMany(Note::class, 'opmerking');
    }

    /**
     * Data relatie voor de gegevens van de persoon die verantwoordelijk is voor het onderhoud van het geveven lokaal. 
     * 
     * @return BelongsTo
     */
    public function verantwoordelijkeOnderhoud(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'verantwoordelijke_onderhoud');
    }
}
