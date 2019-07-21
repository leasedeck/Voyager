<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country 
 * 
 * This model has nog mass-assign or gaurded fields because there is no CRUD operation 
 * For the database table because there only used to viewing and selecting data. 
 * 
 * @package App\Models
 */
class Country extends Model
{
    /**
     * Disable timestamps on the eloquent model. 
     * 
     * @var bool 
     */
    public $timestamps = false;
}
