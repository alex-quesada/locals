<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pais;
use App\Ciudad;
use App\Direccion;
use App\Restaurante;
use App\Persona;
use App\Empleado;
use App\Horas_trabajadas;


class HorasTrabajadasAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empleados = Empleado::all()->toArray();
        $personas = Persona::all()->toArray();
        $paises = Pais::all()->toArray();
        $ciudades = Ciudad::all()->toArray();
        $restaurantes = Restaurante::all()->toArray();
        $direcciones = Direccion::all()->toArray();
        $horasTrabajadas = Horas_trabajadas::all()->toArray();

        if ($request->ajax()) {
            return response()->json(array('personas'=> $personas,'paises' => $paises,
            'ciudades' => $ciudades, 'restaurantes' => $restaurantes,
            'direcciones' => $direcciones,
            'empleados' => $empleados, 'horasTrabajadas' => $horasTrabajadas
            ));
        }
        return view('pagos.horastrabajadas');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pagos.horastrabajadas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $horasTrabajadas = Horas_trabajadas::create($request->all());
        $empleados = Empleado::all()->toArray();
        $personas = Persona::all()->toArray();
        $paises = Pais::all()->toArray();
        $ciudades = Ciudad::all()->toArray();
        $restaurantes = Restaurante::all()->toArray();
        $direcciones = Direccion::all()->toArray();
        $horasTrabajadas = Horas_trabajadas::all()->toArray();
        return response()->json(array('personas'=> $personas,'paises' => $paises,
        'ciudades' => $ciudades, 'restaurantes' => $restaurantes,
        'direcciones' => $direcciones,
        'empleados' => $empleados, 'horasTrabajadas' => $horasTrabajadas));
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
        $horasTrabajadas = Horas_trabajadas::find($id);
        return response()->json(array('horasTrabajadas' => $horasTrabajadas));
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
        $horasTrabajadas = Horas_trabajadas::find($id)->update($request->all());
        $empleados = Empleado::all()->toArray();
        $personas = Persona::all()->toArray();
        $paises = Pais::all()->toArray();
        $ciudades = Ciudad::all()->toArray();
        $restaurantes = Restaurante::all()->toArray();
        $direcciones = Direccion::all()->toArray();
        $horasTrabajadas = Horas_trabajadas::all()->toArray();
        return response()->json(array('personas'=> $personas,'paises' => $paises,
        'ciudades' => $ciudades, 'restaurantes' => $restaurantes,
        'direcciones' => $direcciones,
        'empleados' => $empleados, 'horasTrabajadas' => $horasTrabajadas));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Horas_trabajadas::find($id)->delete();
        return response()->json(['done']);
    }
}
