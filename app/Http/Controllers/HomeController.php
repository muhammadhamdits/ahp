<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PerbandinganKriteria;
use App\PerbandinganAlternatif;

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
            
        }
        return view('welcome', compact('status'));
    }
}
