<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telefonos_restaurante;


class TelefonosRestAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $telefonos = Telefonos_restaurante::all()->toArray();
        if($request->ajax()){
            return response()->json(array('telefonosEmpleado'=>$telefonos));
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
        if($request->telefonosAgregados >= 1){
            for ($i=0; $i < count($request->telefonosAgregados); $i++) { 
                $telefonos = Telefonos_restaurante::create(['telefono_restaurante' => $request->telefonosAgregados[$i]['numero_telefono'],
                'id_restaurante' => $request->id_restaurante]);
            }
        }else {
           $telefonos = Telefonos_restaurante::create($request->all());
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
        $telefonos = Telefonos_restaurante::find($id);
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
        $telefono = Telefonos_restaurante::find($id)->update($request->all());
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
        Telefonos_restaurante::find($id)->delete();
        return response()->json(['done']);
    }
}
