<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address 
 * 
 * @package App\Models
 */
class Address extends Model
{
    /**
     * Mass-assign fields for the database table.
     * 
     * @return array
     */
    protected $fillable = ['type', 'street', 'postal', 'city'];
}
