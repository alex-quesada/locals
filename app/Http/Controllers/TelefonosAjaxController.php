<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telefonos_empleado;


class TelefonosAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $telefonos = Telefonos_empleado::all()->toArray();
        if($request->ajax()){
            return response()->json(array('telefonosEmpleado'=>$telefonos));
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
        if($request->telefonosAgregados >= 1){
            for ($i=0; $i < count($request->telefonosAgregados); $i++) { 
                $telefonos = Telefonos_empleado::create(['telefono_empleado' => $request->telefonosAgregados[$i]['numero_telefono'],
                'tipo_telefono' => $request->telefonosAgregados[$i]['tipo_telefono'], 'id_persona' => $request->id_persona]);
            }
        }else {
           $telefonos = Telefonos_empleado::create($request->all());
        }
        return response()->json($telefonos);
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
        $telefonos = Telefonos_empleado::find($id);
        return response()->json($telefonos);
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
        $telefono = Telefonos_empleado::find($id)->update($request->all());
        return response()->json($telefono);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Telefonos_empleado::find($id)->delete();
        return response()->json(['done']);
    }
}
