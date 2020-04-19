<?php

namespace App\Http\Controllers;

use App\PerbandinganKriteria;
use Illuminate\Http\Request;
use DB;

class PerbandinganKriteriaController extends Controller
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
     * @param  \App\PerbandinganKriteria  $perbandinganKriteria
     * @return \Illuminate\Http\Response
     */
    public function show(PerbandinganKriteria $perbandinganKriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerbandinganKriteria  $perbandinganKriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(PerbandinganKriteria $perbandinganKriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerbandinganKriteria  $perbandinganKriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach($request->perbandingan as $perbandingan){
            $perbandingan = explode("-", $perbandingan);

            DB::update('update perbandingan_kriterias set pembanding_id = ? where kriteria_id_1 = ? and kriteria_id_2 = ?', [$perbandingan[2], $perbandingan[0], $perbandingan[1]]);
        }
        return redirect(route('kriteria.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerbandinganKriteria  $perbandinganKriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerbandinganKriteria $perbandinganKriteria)
    {
        //
    }
}
