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

    public function scopeJoinJabFungsional($q)
    {
        $q->join('rwyt_jab_fungsional', 'rwyt_jab_fungsional.pegawai_id', $this->table.'.pegawai_id');
    }

    public function scopeJoinJabPelaksana($q)
    {
        $q->join('rwyt_jab_pelaksana', 'rwyt_jab_pelaksana.pegawai_id', $this->table.'.pegawai_id');
    }

    public function scopeJoinJabStruktural($q)
    {
        $q->join('rwyt_jab_struktural', 'rwyt_jab_struktural.pegawai_id', $this->table.'.pegawai_id');
    }

    public function scopeJoinJabTambahan($q)
    {
        $q->join('rwyt_jab_tambahan', 'rwyt_jab_tambahan.pegawai_id', $this->table.'.pegawai_id');
    }

    public function jabFungsional()
    {
        return $this->hasOne(JabFungsional::class, 'pegawai_id');
    }

    public function jabStruktural()
    {
        return $this->hasOne(JabStruktural::class, 'pegawai_id');
    }

    public function jabPelaksana()
    {
        return $this->hasOne(JabPelaksana::class, 'pegawai_id');
    }


    public function scopeSearch($q, $request)
    {
        // $q->where('jk', 'P');

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
