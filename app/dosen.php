<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class dosen extends Model
{
    //
    protected $primaryKey = 'nip' ;
    protected $fillable=['nama_dosen','alamat','no_tlp','j_id','mulai_menjabat'];

    public function jabatan()
    {
        return $this->belongsTo('App\jabatan', 'j_id');
    }
    public function pengajuanak()
    {
        return $this->hasMany('App\pengajuanak');
    }
    public function user()
    {
        return $this->belongsTo('App\user', 'user_id');
    }
}
