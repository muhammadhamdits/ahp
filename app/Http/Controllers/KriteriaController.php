<?php

namespace App\Http\Controllers;

use App\Kriteria;
use App\Pembanding;
use App\Alternatif;
use App\PerbandinganKriteria;
use App\PerbandinganAlternatif;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Kriteria::all();
        $perbandingans = PerbandinganKriteria::all();
        $pembandings = Pembanding::all();
        $alternatifs = PerbandinganAlternatif::all();
        return view('kriteria', compact('datas', 'perbandingans', 'pembandings', 'alternatifs'));
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
        $kriteria = Kriteria::create([
            'kriteria' => $request->name
        ]);
        $id = $kriteria->id;
        $kriteria->save();
        
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        if($kriteria->count() > 0){
            foreach($kriteria as $k){
                if($k->id != $id){
                    PerbandinganKriteria::create([
                        'kriteria_id_1' => $k->id,
                        'kriteria_id_2' => $id,
                        'pembanding_id' => 1
                    ])->save();
                }
            }
        }
        if($alternatif->count() > 0){
            foreach($alternatif as $a){
                foreach($alternatif as $b){
                    if($a->id < $b->id){
                        PerbandinganAlternatif::create([
                            'alternatif_id_1' => $a->id,
                            'alternatif_id_2' => $b->id,
                            'kriteria_id' => $id,
                            'pembanding_id' => 1
                        ])->save();
                    }
                }
            }
        }

        return redirect(route('kriteria.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $kriteria = Kriteria::findOrFail($request->aidi);
        $kriteria->kriteria = $request->kriteria;
        $kriteria->save();
        return redirect(route('kriteria.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        return redirect(route('kriteria.index'));
    }

    public function simpanPerbandingan(Request $request){

    }
}
