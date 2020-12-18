<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use App\Models\LineaInvestigacion;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController extends Controller
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
        if (Gate::check('crear-usuario') || Gate::check('editar-usuario')) {
            $usuarios = User::whereHas('roles', function ($query) {
                $query->where('slug', '!=', 'aprendiz');
            })->get();

            $tipoRol = 'otros';

            return view('panel_administracion.users.listar', compact('usuarios', 'tipoRol'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('crear-usuario');

        $roles = Rol::all();
        $lineasInvestigacion = LineaInvestigacion::all();
        return view('panel_administracion.users.crear', compact('roles', 'lineasInvestigacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $lineasInvestigacion = $request->get('lineaInvestigacion');

        $usuario = new User();
        $usuario->nombre            = $request->get('nombre');
        $usuario->email             = $request->get('email');
        $usuario->tipoDocumento     = $request->get('tipoDocumento');
        $usuario->numeroDocumento   = $request->get('numeroDocumento');
        $usuario->numeroCelular     = $request->get('numeroCelular');
        $usuario->tipoVinculacion   = $request->get('tipoVinculacion');
        $usuario->profesion         = $request->get('profesion');
        $usuario->lineaInvestigacion()->associate($lineasInvestigacion);
        // Subir foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            Storage::putFileAs(
                'public/fotos-usuarios', $foto, $foto->getClientOriginalName()
            );
            $usuario->foto = 'fotos-usuarios/'.$foto->getClientOriginalName();
        }
        // $usuario->password                  = bcrypt('admin123'); // Eliminar
        if ($request->get('tipoContrasena') == 'contrasenaNumeroDocumento') {
            $usuario->password = bcrypt($request->input('numeroDocumento')); // Encriptar número de cédula
        } elseif ($request->get('tipoContrasena') == 'contrasenaManual') {
            $usuario->password = bcrypt($request->get('password'));
        }

        $idRol = $request->get('rol_user');
        $usuario->save();

        $usuario->roles()->attach($idRol);

        return redirect()->route('usuarios.index')
            ->with('status', "El usuario {$usuario->nombre} fue agregado con éxito");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('ver-usuario');

        $usuario = User::findOrFail($id);
        return view('panel_administracion.users.ver', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('editar-usuario');

        $usuario    = User::findOrFail($id);
        $roles      = Rol::all();
        $lineasInvestigacion = LineaInvestigacion::all();
        return view('panel_administracion.users.editar', compact('usuario', 'roles', 'lineasInvestigacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $lineasInvestigacion                = $request->get('lineaInvestigacion');

        $usuario                            = User::findOrFail($id);

        $usuario->nombre                    = $request->get('nombre');
        $usuario->email                     = $request->get('email');
        $usuario->tipoDocumento             = $request->get('tipoDocumento');
        $usuario->numeroDocumento           = $request->get('numeroDocumento');
        $usuario->numeroCelular             = $request->get('numeroCelular');
        $usuario->tipoVinculacion           = $request->get('tipoVinculacion');
        $usuario->profesion                 = $request->get('profesion');
        $usuario->lineaInvestigacion()->associate($lineasInvestigacion);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            Storage::putFileAs(
                'public/fotos-usuarios', $foto, $foto->getClientOriginalName()
            );
            $usuario->foto = 'fotos-usuarios/'.$foto->getClientOriginalName();
        }

        $idRol = $request->get('rol_user');
        $usuario->roles()->sync($idRol);

        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('status', "El usuario {$usuario->nombre} ha sido modificado con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        if ( $usuario->foto != '/fotos-usuarios/foto-default.png' ) {
            Storage::delete([$usuario->foto]);
        }

        User::destroy($id);
        return redirect()->route('usuarios.index')
            ->with('status', "El usuario ha sido eliminado con éxito.");
    }

    public function obtenerCoAutores()
    {
        $coautores = User::orderBy('nombre', 'asc')->get();
        return $coautores;
    }

    public function obtenerNotificaciones($id)
    {
        $user = User::findOrFail($id);
        return $user->unreadNotifications->take(4);
    }

    public function marcarNotificacion($id)
    {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    }

    public function listarAprendices()
    {
        $usuarios = User::whereHas('roles', function ($query) {
            $query->where('slug', '=', 'aprendiz');
        })->get();

        $tipoRol = 'aprendiz';
        return view('panel_administracion.users.listar', compact('usuarios', 'tipoRol'));
    }

    public function descargarExcelUsuarios($tipoRol)
    {
        if ($tipoRol == 'aprendiz') {
            $usuarios = User::whereHas('roles', function ($query) {
                $query->where('slug', '=', 'aprendiz');
            })
            ->join('programas_formacion', 'users.programa_formacion_id', 'programas_formacion.id')
            ->select('users.nombre', 'users.email', 'users.tipoDocumento', 'users.numeroDocumento', 'users.numeroCelular', 'programas_formacion.nombre as nombreProgramaFormacion')
            ->orderBy('users.nombre', 'ASC')
            ->get();

            $nombreArchivo = 'Lista de aprendices';
        } elseif ($tipoRol == 'otros') {
            $usuarios = User::whereHas('roles', function ($query) {
                $query->where('slug', '!=', 'aprendiz');
            })
            ->select('users.nombre', 'users.email', 'users.tipoDocumento', 'users.numeroDocumento', 'users.numeroCelular')
            ->orderBy('users.nombre', 'ASC')
            ->get();

            $nombreArchivo = 'Lista de usuarios';
        }

        $spreadsheet    = new Spreadsheet();  /*----Spreadsheet object-----*/
        $spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(24);
        $spreadsheet->getActiveSheet()
        ->fromArray(
            $usuarios->toArray(),   // The data to set
            NULL,        // Array values with this value will not be set
            'A1'         // Top left coordinate of the worksheet range where
            //    we want to set these values (default is A1)
        );
        $writer         = new Xlsx($spreadsheet);

        header("Content-Disposition: attachment; filename={$nombreArchivo}.xlsx");
        $writer->save('php://output');
    }
}
