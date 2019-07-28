<?php

namespace App\Models;

use App\Models\Relations\HasCreator;
use Illuminate\Database\Eloquent\Model;

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
}
