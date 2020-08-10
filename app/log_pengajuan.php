<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log_pengajuan extends Model
{
    //
    protected $table = 'log_pengajuan';

    protected $fillable = ['keterangan','datetime','nip','data_lama','data_baru'];
}
