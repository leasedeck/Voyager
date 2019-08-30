<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Lease
 *
 * @package App\Models
 */
class Lease extends Model
{
    /**
     * De kollommen die beschermd zijn tegen het intern mass-assignment systeem.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * De velden die gemuteerd worden naar een datum/tijd object.
     *
     * @var array
     */
    protected $dates = ['start_datum', 'eind_datum'];

    /**
     * Method om de status van de verhuring op te halen.
     * ---
     * Deze is tijdelijk genoemd naar klasse op interferentie te vermijden met de status kolom in de db.
     *
     * @todo Fix interferentie met databank kolom.
     *
     * @return BelongsTo
     */
    public function klasse(): BelongsTo
    {
        return $this->belongsTo(Tags::class, 'status');
    }

    /**
     * method to fetch the lease period in the applicatition.
     *
     * @return string
     */
    public function getPeriodeAttribute(): string
    {
        return "{$this->start_datum->format('d-m-Y')} - {$this->eind_datum->format('d-m-Y')}";
    }
}
