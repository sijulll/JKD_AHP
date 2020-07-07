<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class komponenkegiatan extends Model
{
    protected $fillable =['jk_id','nama_kegiatan','kegiatan_point','deskripsi'];

    public function jeniskegiatan()
    {
        return $this->belongsTo('App\jeniskegiatan','jk_id');
    }
}
