<?php

namespace App\Http\Controllers\Lokalen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Lokalen;

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
     * @param  Lokalen      $lokaal
     * @param  string|null  $filter
     * @return Renderable
     */
    public function index(Lokalen $lokaal, ?string $filter = null): Renderable
    {
        // TODO
    }
}
