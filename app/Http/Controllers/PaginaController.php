<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function descargarBorrador($nombreArchivo)
    {
        $pathToFile     = storage_path("app/public/archivos/{$nombreArchivo}");

        if (file_exists($pathToFile)) {
            $extension      = '.'.pathinfo($pathToFile)['extension'];
            $nombreArchivo  = 'borrador'.$extension;

            return response()->download($pathToFile, $nombreArchivo);
        }

        return redirect()->back()->with('status-danger', 'El archivo no existe');
    }
}
