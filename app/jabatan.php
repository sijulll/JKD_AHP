<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    protected $fillable = ['nama_jabatan','kum'];

    public function dosen()
    {
        return $this->hasMany('App\dosen');
    }
    public function kriteria()
    {
        return $this->hasMany(kriteria::class);
    }
}
