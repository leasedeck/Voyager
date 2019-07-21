<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Contact;
use App\Models\Country;

/**
 * Class ContactController
 * 
 * @package App\Http\Controllers\Contacts
 */
class ContactController extends Controller
{
    /**
     * Create new ContactController instance. 
     * 
     * @return void
     */
    public function __construct() 
    {
        $this->middleware(['auth', '2fa', 'portal:application', 'forbid-banned-user']);
    }

    /**
     * Method for displaying the index page for the contacts. 
     * 
     * @param  Contact      $contacts   The database storage model for the contacts. 
     * @param  string|null  $filter     The filter criteria name that the user wants to apply. 
     * @return Renderable 
     */
    public function index(Contact $contacts, ?string $filter = null): Renderable
    {
        return view('contacts.overview', ['contacts' => $contacts->paginate()]);
    }

    /**
     * Method for displaying the create view for a new contact person.
     * 
     * @return Renderable
     */
    public function create(): Renderable 
    {
        $addressTypes = ['' => '-- type adres --', 'prive' => 'Privé adres', 'bedrijf' => 'Bedrijfs adres'];
        $countries = Country::all(['id', 'name']);

        return view('contacts.create', compact('addressTypes', 'countries'));
    }
}
