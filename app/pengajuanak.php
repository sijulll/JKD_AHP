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
    public function dosen()
    {
        return $this->belongsTo('App\dosen','nip');
    }
    public function komponenkegiatan()
    {
        return $this->belongsTo('App\komponenkegiatan','id');
    }
}
