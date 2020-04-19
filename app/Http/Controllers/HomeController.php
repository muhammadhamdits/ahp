<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PerbandinganKriteria;
use App\PerbandinganAlternatif;
use App\Kriteria;
use App\Alternatif;

class HomeController extends Controller
{
    public function index(){
        $status = true;
        $pks = PerbandinganKriteria::all();
        $pas = PerbandinganAlternatif::all();

        foreach($pks as $pk){
            if($pk->pembanding_id == 1){
                $status = false;
            }
        }
        foreach($pas as $pa){
            if($pa->pembanding_id == 1){
                $status = false;
            }
        }

        if($status == true){
            $prioritasKriteria = $this->analisisBerpasanganKriteria();
        }
        
        return view('welcome', compact('status'));
    }
    
    public function analisisBerpasanganKriteria(){
        $A = [];
        foreach(Kriteria::all() as $k){
            $B = [];
            foreach(Kriteria::all() as $k2){
                if($k->id == $k2->id){
                    $nilai = 1;
                }else{
                    $nilai = PerbandinganKriteria::where('kriteria_id_1', $k->id)
                                                ->where('kriteria_id_2', $k2->id)
                                                ->first();
                    if($nilai){
                        $nilai = $nilai->pembanding->nilai;
                    }else{
                        $nilai = PerbandinganKriteria::where('kriteria_id_1', $k2->id)
                                                    ->where('kriteria_id_2', $k->id)
                                                    ->first();
                        // dd($k2);
                        $nilai = 1/$nilai->pembanding->nilai;
                    }
                }
                $B[] = $nilai;
            }
            $A[] = $B;
        }
        $jumlahKolom = [];
        for($i = 0; $i < count($A); $i++){
            $C = 0;
            for($j = 0; $j < count($A); $j++){
                $C += $A[$j][$i];
            }
            $jumlahKolom[] = $C;
        }

        $AP = [];
        for($i = 0; $i < count($A); $i++){
            $C = [];
            for($j = 0; $j < count($A); $j++){
                $C[] = $A[$i][$j] / $jumlahKolom[$j];
            }
            $AP[] = $C;
        }
        
        $jumlahBaris = [];
        $prioritas = [];
        $sum = 0;
        for($i = 0; $i < count($A); $i++){
            $C = 0;
            for($j = 0; $j < count($A); $j++){
                $C += $AP[$i][$j];
                $sum += $AP[$i][$j];
            }
            $jumlahBaris[] = $C;
        }

        foreach($jumlahBaris as $jb){
            $prioritas[] = $jb/$sum;
        }
        
        return $prioritas;
    }
}
