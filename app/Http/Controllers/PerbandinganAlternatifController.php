<?php

namespace App\Http\Controllers;

use App\PerbandinganAlternatif;
use Illuminate\Http\Request;
use DB;

class PerbandinganAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\PerbandinganAlternatif  $perbandinganAlternatif
     * @return \Illuminate\Http\Response
     */
    public function show(PerbandinganAlternatif $perbandinganAlternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerbandinganAlternatif  $perbandinganAlternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(PerbandinganAlternatif $perbandinganAlternatif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerbandinganAlternatif  $perbandinganAlternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach($request->perbandinganAlternatif as $perbandingan){
            $perbandingan = explode("-", $perbandingan);

            DB::update('update perbandingan_alternatifs set pembanding_id = ? where alternatif_id_1 = ? and alternatif_id_2 = ? and kriteria_id = ?', [$perbandingan[3], $perbandingan[0], $perbandingan[1], $perbandingan[2]]);
        }
        return redirect(route('kriteria.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerbandinganAlternatif  $perbandinganAlternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerbandinganAlternatif $perbandinganAlternatif)
    {
        //
    }
}
