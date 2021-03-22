<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JabPelaksana extends Model
{
    protected $table = 'rwyt_jab_pelaksana';   
    public $timestamps = false;
    protected $primaryKey = 'pelaksana_id';
}
