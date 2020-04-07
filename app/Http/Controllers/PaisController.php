<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pais;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = DB::table('pais')->paginate(5);
        return view('paises.paises', ['paises' => $paises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paises.crearpais');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $paises = DB::table('pais')->where('nombre_pais', 'like', '%' . $search . '%')->paginate(5);
        return view('paises/paises', ['paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombrePais' => 'required',
            'continentePais' => 'required',
            'codigoTelefono' => 'required'
        ]);

        $nombrePais = $request->get('nombrePais');
        $contientePais = $request->get('continentePais');
        $codigoPais = $request->get('codigoTelefono');
        $pais = DB::insert(
            'insert into pais (nombre_pais, codigo_pais, continente_pais) values (?, ?, ?)',
            [$nombrePais, $codigoPais, $contientePais]
        );
        if ($pais) {
            $red = redirect('/paises')->with('success', 'El país se agrego correctamente');
        } else {
            $red = redirect('/paises/crearpais')->with('danger', 'Hubo un error, intente de nuevo');
        }
        return $red;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paises = DB::select('select * from pais where id_pais = ?', [$id]);
        return view('paises.mostrarpais', ['paises' => $paises]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paises = DB::select('select * from pais where id_pais = ?', [$id]);
        return view('paises.editarpais', ['paises' => $paises]);
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
        $request->validate([
            'nombrePais' => 'required',
            'continentePais' => 'required',
            'codigoTelefono' => 'required'
        ]);

        $nombrePais = $request->get('nombrePais');
        $contientePais = $request->get('continentePais');
        $codigoPais = $request->get('codigoTelefono');
        $paises = DB::update('update pais set nombre_pais =?, continente_pais=?, codigo_pais=? where id_pais = ?', [$nombrePais, $contientePais, $codigoPais, $id]);
        if ($paises) {
            $red = redirect('/paises')->with('success', 'El país se actualizó correctamente');
        } else {
            $red = redirect('/paises/editarpais', $id)->with('danger', 'Hubo un error, intente de nuevo');
        }
        return $red;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paises = DB::delete('delete from pais where id_pais = ?', [$id]);
        $red = redirect('/paises');
        return $red;
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->get('ids');
        $dbs = DB::delete('delete from pais where id_pais in (' . implode(",", $ids) . ')');
        return redirect('/paises');
    }
}
