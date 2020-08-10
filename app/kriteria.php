<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
    // kegiatan
    protected $table = 'bobot_kriteria';
    protected $fillable = ['nilai','jk_id','j_id'];

    public function getjabatan()
    {
        return $this->belongsTo('App\jabatan', 'j_id');
    }
    public function getjeniskegiatan()
    {
        return $this->belongsTo('App\jeniskegiatan', 'jk_id');
    }
}
