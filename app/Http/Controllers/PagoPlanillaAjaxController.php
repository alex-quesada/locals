<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pais;
use App\Ciudad;
use App\Direccion;
use App\Tipo_empleado;
use App\Restaurante;
use App\Persona;
use App\Empleado;
use App\Horas_trabajadas;
use App\Pago_planilla;
use App\Deducciones;
use App\Deducciones_empleado;



class PagoPlanillaAjaxController extends Controller
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
        $pagoPlanillas = Pago_planilla::all()->toArray();

        if ($request->ajax()) {
            return response()->json(array('personas'=> $personas,'paises' => $paises,
            'ciudades' => $ciudades, 'restaurantes' => $restaurantes,
            'direcciones' => $direcciones,
            'empleados' => $empleados, 'horasTrabajadas' => $horasTrabajadas, 'pagoPlanillas' => $pagoPlanillas
            ));
        }
        return view('pagos.pagoplanilla');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pagoPlanillas = Pago_planilla::create($request->all());
        if ($request->deduccionesTotales > 0){
            for ($i=0; $i < count($request->deduccionesTotales); $i++) { 
                $deducciones = Deducciones::create(['porcentaje' => $request->deduccionesTotales[$i]['porcentaje'],
                'detalle' => $request->deduccionesTotales[$i]['detalle']]);
                $deduccionesEmpleado = Deducciones_empleado::create(['deduccion' => $request->deduccionesTotales[$i]['deduccion'],
                'id_deducciones' => $deducciones->id_deduccion,'id_empleado'=> $request->id_empleado]);
            }
        }
        $empleados = Empleado::all()->toArray();
        $personas = Persona::all()->toArray();
        $paises = Pais::all()->toArray();
        $ciudades = Ciudad::all()->toArray();
        $restaurantes = Restaurante::all()->toArray();
        $direcciones = Direccion::all()->toArray();
        $pagoPlanillas = Pago_planilla::all()->toArray();
        return response()->json(array('personas'=> $personas,'paises' => $paises,
        'ciudades' => $ciudades, 'restaurantes' => $restaurantes,
        'direcciones' => $direcciones,
        'empleados' => $empleados, 'pagoPlanillas' => $pagoPlanillas));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
