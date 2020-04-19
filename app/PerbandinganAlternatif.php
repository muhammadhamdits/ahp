<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerbandinganAlternatif extends Model
{
    protected $fillable = ['alternatif_id_1', 'alternatif_id_2', 'kriteria_id', 'pembanding_id'];

    public function alternatif1(){
        return $this->belongsTo('App\Alternatif', 'alternatif_id_1');
    }

    public function alternatif2(){
        return $this->belongsTo('App\Alternatif', 'alternatif_id_2');
    }

    public function kriteria(){
        return $this->belongsTo('App\Kriteria');
    }

    public function pembanding(){
        return $this->belongsTo('App\Pembanding');
    }
}
