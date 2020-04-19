<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerbandinganKriteria extends Model
{
    protected $fillable = ['kriteria_id_1', 'kriteria_id_2', 'pembanding_id'];

    public function kriteria1(){
        return $this->belongsTo('App\Kriteria', 'kriteria_id_1');
    }

    public function kriteria2(){
        return $this->belongsTo('App\Kriteria', 'kriteria_id_2');
    }

    public function pembanding(){
        return $this->belongsTo('App\Pembanding');
    }
}
