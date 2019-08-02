<?php

namespace App\Models;

use App\Models\Relations\HasCreator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Note
 *
 * @package App\Models
 */
class Note extends Model
{
    use HasCreator;

    /**
     * The protected fields for the mass-assignment.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Data relatie voor het lokaal van de notitie.
     *
     * @return MorphTo
     */
    public function lokaal()
    {
        return $this->morphTo('opmerking');
    }
}
