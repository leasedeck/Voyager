<?php

namespace App\Http\Controllers\Lokalen\Werkpunten;

use App\Http\Controllers\Controller;
use App\Models\Lokalen;
use App\Repositories\WerkpuntenRepository;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Lokalen\Werkpunten
 */
class IndexController extends Controller
{
    /** @var WerkpuntenRepository $werkpuntenRepository */
    private $werkpuntenRepository;

    /**
     * IndexController constructor.
     *
     * @param  WerkpuntenRepository $werkpuntenRepository
     * @return void
     */
    public function __construct(WerkpuntenRepository $werkpuntenRepository)
    {
        $this->middleware(['auth', '2fa', 'forbid-banned-user']);
        $this->werkpuntenRepository = $werkpuntenRepository;
    }

    /**
     * Methode om alle werkpunten van het gegeven lokaal weer te geven.
     *
     * @param  Lokalen      $lokaal     De databank entiteit van het gegeven lokaal.
     * @param  string|null  $type       Het type van werkpuntje dat de gebruiker wenst te bekijken.
     * @return Renderable
     */
    public function index(Lokalen $lokaal, ?string $type = null): Renderable
    {
        return view('werkpunten.index', [
            'werkpunten' => $this->werkpuntenRepository->getBasedOnType($lokaal, $type)->paginate(), 'lokaal' => $lokaal
        ]);
    }

    /**
     * Methode voor de weergave van een nieuw werkpuntje.
     *
     * @param  Lokalen  $lokaal De databank entiteit van het gegeven lokaal.
     * @return Renderable
     */
    public function create(Lokalen $lokaal): Renderable
    {
    }
}
