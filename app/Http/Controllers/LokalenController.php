<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Lokalen;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\LokalenFormRequest;

/**
 * Class LokalenController 
 * 
 * @package App\Http\Controllers 
 */
class LokalenController extends Controller
{
    /**
     * Create new LokalenController constructor
     * 
     * @return void
     */
    public function __construct() 
    {
        $this->middleware(['auth', 'portal:application', 'forbid-banned-user']);
    }

    /**
     * Display the index overview page for the "Lokalen"
     * 
     * @param  Lokalen $lokalen The database model entoty for the lokalen in Voyager
     * @return Renderable 
     */
    public function index(Lokalen $lokalen): Renderable 
    {
        return view('lokalen.overview', ['lokalen' => $lokalen->paginate()]);
    }

    /**
     * Method to display the create page for an new "Lokaal"
     * 
     * @return Renderable
     */
    public function create(): Renderable 
    {
        $users = User::all(['voornaam', 'achternaam', 'id']);
        $capacityTypes = ['n.v.t' => 'Niet van toepassing', 'personen' => 'Personen', 'slaapplekken' => 'Slaapplekken'];
        $todoSelect = [
            0 => 'Nee, ik wens het beheersysteem voor werkpunten niet te gebruiken.',
            1 => 'Ja, ik wens het beheersysteem voor werkpunten te gebruiken.', 
        ];

        return view('lokalen.create', compact('capacityTypes', 'users', 'todoSelect'));
    }

    /**
     * @todo docblock 
     * @todo write controller logic 
     * @todo Implement validation
     */
    public function store(LokalenFormRequest $input, Lokalen $lokalen): RedirectResponse
    {
        dd($input->all());
    }
}
