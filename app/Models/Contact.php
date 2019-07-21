<?php

namespace App\Models;

use App\Models\Relations\HasCreator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Contact
 * 
 * @package App\Models
 */
class Contact extends Model
{
    use HasCreator; 

    /**
     * The mass-assignable fields for the database table. 
     * 
     * @return array
     */
    protected $fillable = ['voornaam', 'achternaam', 'email', 'organisatie', 'organisatie_functie', 'telefoon_nummer'];

    /**
     * Data relation for the addresses that are attached to the Contact person 
     * 
     * @return HasMany
     */
    public function addresses(): HasMany 
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Method for compiling the full name of the contact person. 
     * 
     * @return string
     */
    public function getNameAttribute(): string 
    {
        return ucfirst($this->voornaam) . " " .  ucfirst($this->achternaam);
    }
}
