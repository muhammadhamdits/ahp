<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembanding extends Model
{
    protected $table = 'pembandings';
    protected $fillable = ['nama', 'nilai'];
}
