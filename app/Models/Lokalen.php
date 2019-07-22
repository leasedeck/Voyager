<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

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
     */
    public function verantwoordelijkeAlgemeen(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'verantwoordelijke_algmeen');
    }

    /**
     * Data relatie voor de gegevens van de persoon die verantwoordelijk is
     * voor het onderhoud van het geveven lokaal. 
     * 
     * @return BelongsTo
     */
    public function verantwoordelijkeOnderhoud(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'verantwoordelijke_onderhoud');
    }
}
