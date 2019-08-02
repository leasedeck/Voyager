<?php

namespace App\Http\Controllers\Lokalen;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lokalen\OpmerkingFormRequest;
use App\Models\Lokalen;
use App\Models\Note;
use App\Traits\LokalenSharedMethods;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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
        $opmerkingen = $lokaal->opmerkingen()->latest()->simplePaginate();
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

    /**
     * Methode om een notitie die gekoppeld is aan het lokaal weer te geven.
     *
     * @param  Note $note De databank entiteit van de lokaal notitie (opmerking).
     * @return Renderable
     */
    public function show(Note $note): Renderable
    {
        $lokaal = $note->lokaal; // Lokaal entiteit nodig voor de navigatie.
        $counters = $this->getNavigationCounters($lokaal);

        return view('lokalen.opmerkingen.show', compact('note', 'lokaal', 'counters'));
    }

    /**
     * Methode om de opmerking van een lokaal op te slaan in Voyager.
     *
     * @param  OpmerkingFormRequest $request    De validator instantie voor de request.
     * @param  Lokalen              $lokaal     De gegeven databank entiteit van het gegeven lokaal.
     * @return RedirectResponse
     */
    public function store(OpmerkingFormRequest $request, Lokalen $lokaal): RedirectResponse
    {
        DB::transaction(static function () use ($request, $lokaal): void {
            $opmerking = new Note($request->all());
            $lokaal->opmerkingen()->save($opmerking);
            $opmerking->setCreator($request->user());

            flash('De notitie is opgeslagen in de applicatie.');
        });

        return redirect()->route('lokalen.opmerkingen', $lokaal);
    }

    /**
     * Methode om een lokaal notitie te verwijderen uit het systeem.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @param Note $note De entiteit van de notitie in de databank.
     * @return RedirectResponse
     */
    public function destroy(Note $note): RedirectResponse
    {
        $this->authorize('verwijder-opmerking', $note);

        DB::transaction(static function () use ($note): void {
            $note->delete();

            (new Controller)->getAuthenticatedUser()->logActivity($note, 'Notities', "Heeft een notitie van het {$note->lokaal->naam} verwijderd.");
            flash("De opmerking van het {$note->lokaal->naam} is verwijderd in de applicatie.");
        });

        return redirect()->route('lokalen.opmerkingen', $note->lokaal);
    }
}
