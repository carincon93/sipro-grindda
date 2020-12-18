<?php

namespace App\Http\Controllers;

use App\Models\Rol;

use App\Http\Requests\RolRequest;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        return view('panel_administracion.roles.listar', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::whereHas('usuarios')->where('roles.nivelSeguridad', 5)->get();

        return view('panel_administracion.roles.crear', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        $permisos           = $request->get('permisos');
        $truesPermisos      = [];
        $truesPermisos      = array_pad($truesPermisos, count($permisos), true);
        $permisos           = array_combine($permisos, $truesPermisos);
        json_encode($permisos);

        if ($request->has('usuarioNotificacion')) {
            $usuarioNotificacion    = $request->get('usuarioNotificacion');
            $trues                  = [];
            $trues                  = array_pad($trues, count($usuarioNotificacion), true);
            $usuarioNotificacion    = array_combine($usuarioNotificacion, $trues);
            json_encode($usuarioNotificacion);
        } else {
            $usuarioNotificacion = null;
        }

        $rol = new Rol();
        $rol->nombre                = $request->get('nombre');
        $rol->slug                  = str_slug($request->get('nombre'));
        $rol->descripcion           = $request->get('descripcion');
        $rol->permisos              = $permisos;
        $rol->usuarioNotificacion   = $usuarioNotificacion;
        $rol->nivelSeguridad        = $request->get('nivelSeguridad');

        $rol->save();

        return redirect()->route('roles.index')
            ->with('status', "El rol ha sido creado con éxito.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Rol::findOrFail($id);

        return view('panel_administracion.roles.ver', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol    = Rol::find($id);
        $roles  = Rol::whereHas('usuarios')->where('roles.nivelSeguridad', 5)->get();
        return view('panel_administracion.roles.editar', compact('rol', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, $id)
    {
        $permisos           = $request->get('permisos');
        $truesPermisos      = [];
        $truesPermisos      = array_pad($truesPermisos, count($permisos), true);
        $permisos           = array_combine($permisos, $truesPermisos);
        json_encode($permisos);

        if ($request->has('usuarioNotificacion')) {
            $usuarioNotificacion    = $request->get('usuarioNotificacion');
            $trues                  = [];
            $trues                  = array_pad($trues, count($usuarioNotificacion), true);
            $usuarioNotificacion    = array_combine($usuarioNotificacion, $trues);
            json_encode($usuarioNotificacion);
        } else {
            $usuarioNotificacion = null;
        }

        $rol = Rol::findOrFail($id);
        $rol->nombre                = $request->get('nombre');
        $rol->slug                  = str_slug($request->get('nombre'));
        $rol->descripcion           = $request->get('descripcion');
        $rol->permisos              = $permisos;
        $rol->usuarioNotificacion   = $usuarioNotificacion;
        $rol->nivelSeguridad        = $request->get('nivelSeguridad');

        $rol->save();

        return redirect()->route('roles.index')
            ->with('status', "El rol ha sido modificado con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rol::destroy($id);
        return redirect()->route('roles.index')
            ->with('status', "El rol ha sido eliminado con éxito.");
    }
}
