<?php 

namespace App\Traits;

use App\Models\Lokalen;

/**
 * Trait LokalenSharedMethod 
 * 
 * @package App\Traits
 */
trait LokalenSharedMethods 
{
    /**
     * Methode voor de counters van de lokaal navigatie.
     * 
     * @param  Lokalen $lokaal De naam van het gegeven lokaal.
     * @return array
     */
    public function getNavigationCounters(Lokalen $lokaal): array 
    {
        return [
            'opmerkingen' => $lokaal->opmerkingen()->count(),
        ];
    }
}