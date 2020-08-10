<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengajuanak extends Model
{
    //
    protected $fillable = ['user_id','dosen_id','jk_id','kk_id','files'];
    public function user()
    {
        return $this->belongsTo('App\User','id');
    }
    public function getDosen()
    {
        return $this->belongsTo('App\dosen','dosen_id');
    }
    public function getKomponenkegiatan()
    {
        return $this->belongsTo('App\komponenkegiatan','kk_id');

    }
}
