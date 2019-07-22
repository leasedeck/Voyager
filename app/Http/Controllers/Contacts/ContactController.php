<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Contact;
use App\Models\Country;
use App\Http\Requests\Contacts\ContactFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Address;

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

    /**
     * Method for storing a new contact person in the application. 
     * 
     * @param  ContactFormRequest $input The request class that handles the validation and contains request data
     * @return RedirectResponse
     */
    public function store(ContactFormRequest $input): RedirectResponse 
    {
        DB::transaction(static function () use ($input) {
            $contact = Contact::create($input->all());
            $contact->setCreator($input->user());

            if ($input->anyFilled(['type', 'street', 'postal', 'city', 'country'])) {
                dd($input->all(), true);
                $address = Address::create($input->all());
                $contact->addresses()->save($address);
            }

            (new Controller)->getAuthenticatedUser()
                ->logActivity($contact, 'Contactpersonen', "Heeft {$contact->name} toegevoegd als contactpersoon."); 
        });

        return redirect()->route('contact.index');
    }

    /**
     * Method for deleting a contact person out of Voyager. 
     * 
     * @param  Contact $contact The resource entity from the contact person.
     * @return RedirectResponse
     */
    public function destroy(Contact $contact): RedirectResponse 
    {
        DB::transaction(static function () use($contact): void {
            $contact->delete();
    
            if (Contact::count() > 0) {
                flash("{$contact->name} is verwijderd uit ". config('app.name') ." als contactpersoon.", 'success');
            }
        
            (new Controller)->getAuthenticatedUser()
                ->logActivity($contact, 'Contactpersonen', "Heeft {$contact->name} verwijderd als contactpersoon.");       
        });

        return redirect()->route('contacts.index');
    }
}
