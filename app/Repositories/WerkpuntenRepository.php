<?php

namespace App\Repositories;

use App\Models\Lokalen;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class WerkpuntenRepository
 *
 * @package App\Repositories\WerkpuntenRepository
 */
class WerkpuntenRepository
{
    /**
     * Methode om alle werkpunten gebaseerd op het gegeven type op te halen in de applicatie.
     *
     * @param  string $type De gegeven criteria van de gebruiker.
     * @return Builder
     */
    public function getBasedOnType(Lokalen $lokaal, string $type): Builder
    {
        $instance = $lokaal::query();

        return $instance;
    }
}
