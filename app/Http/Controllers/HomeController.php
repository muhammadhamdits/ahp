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
        $prioritasAkhir = [];
        $imax = 0;
        $pks = PerbandinganKriteria::all();
        $pas = PerbandinganAlternatif::all();
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        $best = "-";
        
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
                            $nilai = 1/$nilai->pembanding->nilai;
                        }
                    }
                    $B[] = $nilai;
                }
                $A[] = $B;
            }
            $prioritasKriteria = $this->analisisBerpasangan($A);

            $kriteriaAlternatif = [];
            foreach(Kriteria::all() as $krit){
                $A = [];
                foreach(Alternatif::all() as $k){
                    $B = [];
                    foreach(Alternatif::all() as $k2){
                        if($k->id == $k2->id){
                            $nilai = 1;
                        }else{
                            $nilai = PerbandinganAlternatif::where('alternatif_id_1', $k->id)
                                                        ->where('alternatif_id_2', $k2->id)
                                                        ->where('kriteria_id', $krit->id)
                                                        ->first();
                            if($nilai){
                                $nilai = $nilai->pembanding->nilai;
                            }else{
                                $nilai = PerbandinganAlternatif::where('alternatif_id_1', $k2->id)
                                                            ->where('alternatif_id_2', $k->id)
                                                            ->where('kriteria_id', $krit->id)
                                                            ->first();
                                $nilai = 1/$nilai->pembanding->nilai;
                            }
                        }
                        $B[] = $nilai;
                    }
                    $A[] = $B;
                }
                $kriteriaAlternatif[] = $A;
            }

            $prioritasAlternatif = [];
            foreach($kriteriaAlternatif as $A){
                $prioritasAlternatif[] = $this->analisisBerpasangan($A);
            }

            $matriksAkhir = [];
            for($i = 0; $i < count($prioritasAlternatif); $i++){
                $A = [];
                for($j = 0; $j < count($prioritasAlternatif[$i]); $j++){
                    $A[] = $prioritasKriteria[$i] * $prioritasAlternatif[$i][$j];
                }
                $matriksAkhir[] = $A;
            }

            for($i = 0; $i < count($matriksAkhir[0]); $i++){
                $rata = 0;
                for($j = 0; $j < count($prioritasKriteria); $j++){
                    $rata += $matriksAkhir[$j][$i];
                }
                $prioritasAkhir[] = $rata;
            }
            $max = 0;
            foreach($prioritasAkhir as $key => $p){
                if($p > $max){
                    $max = $p;
                    $imax = $key;
                }
            }
            $best = $alternatif[$imax]->alternatif;
        }
        
        return view('welcome', compact('status', 'prioritasAkhir', 'alternatif', 'kriteria', 'best'));
    }
    
    public function analisisBerpasangan($A){
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
