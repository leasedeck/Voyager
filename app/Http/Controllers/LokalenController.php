<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Lokalen;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\LokalenFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Traits\LokalenSharedMethods;

/**
 * Class LokalenController 
 * 
 * @package App\Http\Controllers 
 */
class LokalenController extends Controller
{
    use LokalenSharedMethods; 

    /**
     * Create new LokalenController constructor
     * 
     * @return void
     */
    public function __construct() 
    {
        $this->middleware(['auth', '2fa', 'portal:application', 'forbid-banned-user']);
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
     * Methode voor het weergeven van de informatie omtrent het gegeven lokaal. 
     * 
     * @todo Implementatie update method
     * @todo Opbouwen van de logica om de gegevens te wijzigen
     * 
     * @param  Lokalen $lokaal De databank entiteit van het gegeven lokaal.
     * @return Renderable
     */
    public function show(Lokalen $lokaal): Renderable
    {
        $counters = $this->getNavigationCounters($lokaal);
        $users = User::all(['voornaam', 'achternaam', 'id']);
        $capacityTypes = ['n.v.t' => 'Niet van toepassing', 'personen' => 'Personen', 'slaapplekken' => 'Slaapplekken'];
        $todoSelect = [
            0 => 'Nee, ik wens het beheersysteem voor werkpunten niet te gebruiken.',
            1 => 'Ja, ik wens het beheersysteem voor werkpunten te gebruiken.', 
        ];

        return view('lokalen.show', compact('lokaal', 'capacityTypes', 'users', 'todoSelect', 'counters'));
    }

    /**
     * Methode voor het opslaan van een lokaal in Voyager. 
     * 
     * @see \App\Observers\LokalenObserver::created()
     *
     * @param  LokalenFormRequest   $input  De instantie dat de validatie van inputs regelt en info bezit van de request.
     * @param  Lokalen              $lokaal Entiteit van de database model. 
     * @return RedirectResponse
     */
    public function store(LokalenFormRequest $input, Lokalen $lokaal): RedirectResponse
    {
        DB::transaction(static function () use ($input, $lokaal): void {
            $lokaal = $lokaal->create($input->all()); // Verantwoordelijke relaties worden standaard meegegeven met de entiteit creatie.

            if ($lokaal->count() > 0) {
                flash("Het <strong>{$lokaal->naam}</strong> is opgeslagen in " . config('app.name'), 'success');
            }
        });

        return redirect()->route('lokalen.index');
    }

    /**
     * Methode om een lokaal te verwijderen uit Voyager.  
     * 
     * @param  Request $request De instantie voor de data van de request
     * @param  Lokalen $lokaal  De databank entiteit van het gegeven lokaal.
     * @return Renderable|RedirectResponse
     */
    public function destroy(Request $request, Lokalen $lokaal)
    {
        $this->authorize('delete', $lokaal);

        if ($request->isMethod('GET')) {
            $counters = $this->getNavigationCounters($lokaal);
            return view('lokalen.delete', compact('lokaal', 'counters'));
        }

        DB::transaction(static function () use ($lokaal, $request): void { // HTTP - DELETE logic
            $lokaal->delete();
            $request->user()->logActivity($lokaal, 'Lokalen', "Heeft het {$lokaal->naam} verwijderd uit " . config('app.name'));
            
            if (Lokalen::count() > 0) {
                flash("Het <strong>{$lokaal->naam}</strong> is met succes verwijderd uit " . config('app.name'))->important();
            }
        });

        return redirect()->route('lokalen.index');
    }
}
