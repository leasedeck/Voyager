<?php

namespace App\Http\Controllers\Lokalen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Lokalen;
use App\Traits\LokalenSharedMethods;

/**
 * Class NotesController
 * 
 * @package App\Http\Controllers\Lokalen
 */
class NotesController extends Controller
{
    use LokalenSharedMethods; 

    /**
     * Create new NotesController constructor
     * 
     * @return void
     */
    public function __construct() 
    {
        $this->middleware(['auth', '2fa', 'portal:application', 'forbid-banned-user']);
    }

    /**
     * Methode voor het weergeven van alle opmerkingen omtrent het gegeven lokaal. 
     * 
     * @param  Lokalen      $lokaal The gegeven database entiteit van het gegeven lokaal.
     * @param  string|null  $filter The filter criteria de gebruiker wilt toepassen op de resultaten.π
     * @return Renderable
     */
    public function index(Lokalen $lokaal, ?string $filter = null): Renderable
    {
        $opmerkingen = $lokaal->opmerkingen()->simplePaginate(); 
        $counters    = $this->getNavigationCounters($lokaal);

        return view('lokalen.opmerkingen.index', compact('lokaal', 'opmerkingen', 'counters'));
    }

    /**
     * Methode voor de weergave van een nieuwe opmerking.
     * 
     * @param  Lokalen $lokaal De gegeven databank entiteit van het gegeven lokaal.
     * @return Renderable
     */
    public function create(Lokalen $lokaal): Renderable 
    {
        $counters = $this->getNavigationCounters($lokaal);
        return view('lokalen.opmerkingen.create', compact('lokaal', 'counters'));
    }
}
