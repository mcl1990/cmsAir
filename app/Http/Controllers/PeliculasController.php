<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Configuraciones\Categoria;
use App\Models\Configuraciones\MenuCategoria;
use App\Models\Registros\Pelicula;

class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::whereStatus(true)->with('menus')->get();
        $peliculas = Pelicula::whereStatus(true)
        ->has('aportes')
        ->paginate(12);
        
        return view('registros.peliculas.index',[
            'categorias' => $categorias,
            'aportes' => $peliculas,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('registros.peliculas.detalle')->with('pelicula',$pelicula);
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

    public function aportesData($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $aportes = $pelicula->aportes;
        $datos = [];
        foreach ($aportes as $a) {
            $fila = [
                'opcion' => 'Ver',
                'servidor' => 'mega.nz',
                'audio' => $a->audio->audio,
                'calidad' => $a->resolucion->calidad,
                'usuario' => $a->usuario->name,
                'visto' => '322',
                'peso' => $a->peso . $a->tamano->tamano,
            ];
            $datos[] = $fila;
        }
        return Datatables::of($datos)
            ->make(true);
    }
}
