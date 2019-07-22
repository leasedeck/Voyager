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
     * 
     * @return BelongsTo
     */
    public function verantwoordelijkeAlgemeen(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'verantwoordelijke_algemeen');
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

    /**
     * Methode voor het attacheren van de gebruikers entiteiten aan de posities als verantwoordelijke van het gegeven lokalen. 
     *  
     * @param  int $verantwoordelijkeAlg    De unieke numerieke waarde van de algemene verantwoordelijke.
     * @param  int $verantwoordelijkeOnd    De unieke numerieke waarde van de onderhouds verantwoordelijke.
     * @return void 
     */
    public function attacheerVerantwoordelijke(int $verantwoordelijkeAlg, int $verantwoordelijkeOnd): void 
    {
        $this->verantwoordelijkeAlgemeen()->associate($verantwoordelijkeAlg)->save();
        $this->verantwoordelijkeOnderhoud()->associate($verantwoordelijkeOnd)->save();
    }
}
