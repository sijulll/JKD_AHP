<?php

namespace App\Http\Controllers\Admin;
use App\log_pengajuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

class LogAktifitasController extends Controller
{

    public function getLogDosen()
    {
        $logData = DB::table('log_pengajuan')->where('data_baru','=','0')->Orderby('id_log','desc')->get();
        return view('admin.log_dosen',compact('logData'));
    }

    public function getLogPenilai()
    {
        $logData = DB::table('log_pengajuan')->where('data_baru','!=','0')->Orderby('id_log','desc')->get();
        return view('admin.log_penilai',compact('logData'));
    }
}
