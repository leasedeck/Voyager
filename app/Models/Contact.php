<?php

namespace App\Models;

use App\Models\Relations\HasCreator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * 
 * @package App\Models
 */
class Contact extends Model
{
    use HasCreator; 

    /**
     * The fields that are protected from mass-assignment
     * 
     * @var array
     */
    protected $guarded = ['id'];
}
