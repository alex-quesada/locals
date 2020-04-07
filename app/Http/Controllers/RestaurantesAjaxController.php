<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ciudad;
use App\Pais;
use App\Restaurante;
use App\Direccion;
use App\Telefonos_restaurante;


class RestaurantesAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paises = Pais::all()->toArray();
        $ciudades = Ciudad::all()->toArray();
        $restaurantes = Restaurante::all()->toArray();
        $direcciones = Direccion::all()->toArray();
        $telefonosRest = Telefonos_restaurante::all()->toArray();
        if ($request->ajax()) {
            return response()->json(array('telefonosRest'=> $telefonosRest, 'paises' => $paises, 'ciudades' => $ciudades, 'restaurantes' => $restaurantes, 'direcciones' => $direcciones));
        }
        return view('restaurantes.restaurantesajax');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurantes.restaurantesajax');
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
        $restaurante = Restaurante::create(['id_direccion' => $direccion->id_direccion]);
        return response()->json($restaurante);
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
        $restaurantes = Restaurante::find($id);
        $direcciones = Direccion::find($restaurantes->id_direccion);
        $ciudades = Ciudad::find($direcciones->id_ciudad);
        $paises = Pais::find($ciudades->id_pais);
        return response()->json(array('paises' => $paises, 'ciudades' => $ciudades, 'restaurantes' => $restaurantes, 'direcciones' => $direcciones));

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
        $restaurante = Restaurante::find($id);
        $direccion = Direccion::find($restaurante->id_direccion)->update($request->all());
        return response()->json($restaurante);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Restaurante::find($id)->delete();
        return response()->json(['done']);
    }
}
