<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
