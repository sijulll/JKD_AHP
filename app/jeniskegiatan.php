<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jeniskegiatan extends Model
{
    //Jenis Kegiatan dari angka Kum yg akan didapat

    protected $fillable = ['nama_jk','deskripsi'];

    public function komponenkegiatan()
    {
        return $this->hasMany(komponenkegiatan::class);
    }
    public function kriteria()
    {
        return $this->hasMany(kriteria::class);
    }
}
