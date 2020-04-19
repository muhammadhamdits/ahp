<?php

namespace App\Http\Controllers;

use App\Alternatif;
use App\Kriteria;
use App\PerbandinganAlternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Alternatif::all();
        return view('alternatif', compact('datas'));
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
        $alternatif = Alternatif::create([
            'alternatif' => $request->name
        ]);
        $id = $alternatif->id;
        $alternatif->save();
        
        $kriterias = Kriteria::all();
        $alternatif = Alternatif::all();
        if($kriterias->count() > 0){
            foreach($kriterias as $k){
                if($alternatif->count() > 0){
                    foreach($alternatif as $a){
                        if($a->id != $id){
                            PerbandinganAlternatif::create([
                                'alternatif_id_1' => $a->id,
                                'alternatif_id_2' => $id,
                                'kriteria_id' => $k->id,
                                'pembanding_id' => 1
                            ])->save();
                        }
                    }
                }
            }
        }

        return redirect(route('alternatif.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function show(Alternatif $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternatif $alternatif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $alternatif = Alternatif::findOrFail($request->aidi);
        $alternatif->alternatif = $request->alternatif;
        $alternatif->save();
        return redirect(route('alternatif.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect(route('alternatif.index'));
    }
}
