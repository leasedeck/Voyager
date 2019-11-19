<?php

namespace App\Http\Controllers\Lokalen\Werkpunten;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Lokalen\Werkpunten
 */
class IndexController extends Controller
{
    /**
     * IndexController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'forbid-banned-user']);
    }

    /**
     * Methode om alle werkpunten van het gegeven lokaal weer te geven.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {

    }
}
