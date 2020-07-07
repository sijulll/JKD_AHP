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

}
