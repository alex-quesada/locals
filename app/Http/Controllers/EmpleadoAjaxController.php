<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pais;
use App\Ciudad;
use App\Direccion;
use App\Tipo_empleado;
use App\Restaurante;
use App\Persona;
use App\Telefonos_empleado;
use App\Empleado;

class EmpleadoAjaxController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empleados = Empleado::all()->toArray();
        $telefonosEmpleado = Telefonos_empleado::all()->toArray();
        $tipoEmpleados = Tipo_empleado::all()->toArray();
        $personas = Persona::all()->toArray();
        $paises = Pais::all()->toArray();
        $ciudades = Ciudad::all()->toArray();
        $restaurantes = Restaurante::all()->toArray();
        $direcciones = Direccion::all()->toArray();

        if ($request->ajax()) {
            return response()->json(array('tipoEmpleados'=> $tipoEmpleados,
            'personas'=> $personas,'paises' => $paises,
            'ciudades' => $ciudades, 'restaurantes' => $restaurantes,
            'direcciones' => $direcciones,
            'empleados' => $empleados,
            'telefonosEmpleado' => $telefonosEmpleado));
        }
        return view('empleados.empleadosajax');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.empleadosajax');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $direccion = Direccion::create($request->all());
        $persona = Persona::create(['id_direccion' => $direccion->id_direccion,
        'id_persona' => $request->id_persona, 'nombre' => $request->nombre,
        'apellido_uno' => $request->apellido_uno, 'apellido_dos' => $request->apellido_dos,
        'correo' => $request->correo]);
        $empleado = Empleado::create($request->all());
        return response()->json($empleado);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleados = Empleado::find($id);
        $telefonos = Persona::find($empleados->id_persona)->telefonos;
        $personas = Persona::find($empleados->id_persona);
        $direcciones = Direccion::find($personas->id_direccion);
        $tipoEmpleados = Tipo_empleado::find($empleados->id_tipo_empleado);
        $ciudades = Ciudad::find($direcciones->id_ciudad);
        $paises = Pais::find($ciudades->id_pais);
        $restaurantes = Restaurante::find($empleados->id_restaurante);
        $dirRest = Direccion::find($restaurantes->id_direccion);
        $ciudRest = Ciudad::find($dirRest->id_ciudad);
        return response()->json(array('empleados' => $empleados,
                                      'personas' => $personas,
                                      'direcciones' => $direcciones,
                                      'tipoEmpleados' => $tipoEmpleados,
                                      'ciudades' => $ciudades,
                                      'paises' => $paises,
                                      'restaurantes' => $restaurantes,
                                      'telefonosEmpleado' =>$telefonos,
                                      'dirRest' => $dirRest,
                                       'ciudadRest' => $ciudRest));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($request->id_empleado);
        $persona = Persona::find($empleado->id_persona);
        $direccion = Direccion::find($persona->id_direccion)->update(['direccion_uno' => $request->direccion_uno,
        'id_ciudad' => $request->id_ciudad]);
        $direccion = Direccion::find($persona->id_direccion);
        $persona = Persona::find($empleado->id_persona)->update(['id_persona' => $request->id_persona, 
        'nombre' => $request->nombre, 'apellido_uno' => $request->apellido_uno,
        'apellido_dos' => $request->apellido_dos, 'correo' => $request->correo,
        'id_direccion' => $direccion->id_direccion]);
        $empleado = Empleado::find($request->id_empleado)->update(['fecha_ingreso' => $request->fecha_ingreso,
        'id_persona' => $request->id_persona, 'id_tipo_empleado' => $request->id_tipo_empleado, 'id_restaurante' => $request->id_restaurante,
        'salario_por_hora' => $request->salario_por_hora]);
        $empleados = Empleado::all();
        return response()->json($empleados);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empleado::find($id)->delete();
        return response()->json(['done']);
    }
}
