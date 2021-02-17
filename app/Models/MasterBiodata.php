<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBiodata extends Model
{
    protected $table = 'biodata';   
    public $timestamps = false;
    protected $primaryKey = 'pegawai_id';

    protected $fillable = ['nip_baru'];

    public function riwayatSuamiIstri()
    {
        return $this->belongsTo(MasterSuamiIstri::class, 'pegawai_id');
    }


    public function fileDiri()
    {
        return $this->hasOne(FileDiri::class, 'pegawai_id');
    }

    public function suamiIstri()
    {
        return $this->hasOne(MasterSuamiIstri::class, 'pegawai_id');
    }

    public function scopeSearch($q, $request)
    {
        $q->where('jk', 'P');

        $columns = $request['column'] ?? [];
        foreach ($columns as $key => $column) {
            $operator = $request['operator'][$key];
            $keyword = $request['keyword'][$key];
            if ($operator == 'like' || $operator == 'contains') {
                $q->where($column, 'like', '%'.$keyword.'%');
            } else {
                $q->where($column, $operator, $keyword);
            }
        }

        return $q;
    }
}
