<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Semillero;

use Illuminate\Http\Request;

class PanelAdministracionController extends Controller
{
    public function index()
    {
        $semilleros = Semillero::all();
        return view('panel_administracion.index', compact('semilleros'));
    }
}
