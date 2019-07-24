<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Lokalen;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\LokalenFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
     * Methode voor het opslaan van een lokaal in Voyager. 
     * 
     * @todo Register observer for sending out the notifications. (Lokaal verantwoordelijk en onderhouds verantwoordelijke)
     *
     * @param  LokelenFormRequest   $input  De instantie dat de validatie van inputs regelt en info bezit van de request.
     * @param  Lokalen              $lokaal Entiteit van de database model. 
     * @return RedirectResponse
     */
    public function store(LokalenFormRequest $input, Lokalen $lokaal): RedirectResponse
    {
        DB::transaction(static function () use ($input, $lokaal): void {
            $lokaal = $lokaal->create($input->except('verantwoordelijke_algemeen', 'verantwoordelijke_onderhoud'));
            $lokaal->attacheerVerantwoordelijke($input->verantwoordelijke_algemeen, $input->verantwoordelijke_onderhoud);

            if ($lokaal->count() > 0) {
                flash("Het <strong>{$lokaal->name}</strong> is opgeslagen in " . config('app.name'), 'success');
            }
        });

        return redirect()->route('lokalen.index');
    }

    /**
     * Methode om een lokaal te verwijderen uit Voyager. 
     * 
     * @todo Registratie en embedding van de routering.
     * @todo Creatie confirmatie weergave
     * @todo Implementatie controller logic.
     * 
     * @param  Request $request De instantie voor de data van de request
     * @param  Lokalen $lokaal  De databank entiteit van het gegeven lokaal.
     * @return Renderable|RedirectResponse
     */
    public function destroy(Request $request, Lokalen $lokalen)
    {
        if ($request->isMethod('GET')) {
            return view();
        }
    }
}
