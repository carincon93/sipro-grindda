<?php

namespace App\Http\Controllers;

use App\Models\LogoAliado;

use App\Http\Requests\LogoAliadoRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class LogoAliadoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logosAliados = LogoAliado::all();
        return view('panel_administracion.logos_aliados.listar', compact('logosAliados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel_administracion.logos_aliados.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LogoAliadoRequest $request)
    {
        $logoAliado = new LogoAliado();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $rutaLogo  = Storage::putFileAs(
                'public/logos-caja-ideas', $logo, $logo->getClientOriginalName()
            );

            $logoAliado->logo  = 'logos-caja-ideas/'.$logo->getClientOriginalName();
        }

        $logoAliado->save();

        return redirect()->route('logos_aliados.index')->with('status', 'El logo del aliado se ha registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logoAliado = LogoAliado::findOrFail($id);

        return view('panel_administracion.logos_aliados.ver', compact('logoAliado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logoAliado = LogoAliado::findOrFail($id);

        return view('panel_administracion.logos_aliados.editar', compact('logoAliado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LogoAliadoRequest $request, $id)
    {
        $logoAliado = LogoAliado::findOrFail($id);

        if ($request->hasFile('logo')) {
            $rutaLogo  = Storage::putFile(
                'public/logos-caja-ideas', $request->file('logo')
            );

            $logoAliado->logo = $rutaLogo;
        }

        $logoAliado->save();

        return redirect()->route('logos_aliados.index')->with('status', 'El logo del aliado se ha modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LogoAliado::destroy($id);
        return redirect()->route('logos_aliados.index')
            ->with('status', 'El logo del aliado ha sido eliminado con éxito.');
    }
}
