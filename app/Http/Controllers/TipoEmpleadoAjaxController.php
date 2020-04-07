<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_empleado;

class TipoEmpleadoAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipoEmpleados = Tipo_empleado::all();
        if ($request->ajax()) {
            return response()->json($tipoEmpleados);
        }
        return view('empleados.tipoempleadoajax');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.tipoempleadoajax');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoEmpleado = Tipo_empleado::create($request->all());
        return response()->json($tipoEmpleado);
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
        $tipoEmpleado = Tipo_empleado::find($id);
        return response()->json($tipoEmpleado);
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
        $tipoEmpleado = Tipo_empleado::find($id)->update($request->all());
        return response()->json($tipoEmpleado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tipo_empleado::find($id)->delete();
        return response()->json(['done']);
    }
}
