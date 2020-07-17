<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\jabatan;
use DB;
use Auth;
use App\komponenkegiatan;
use App\jeniskegiatan;
use App\dosen;
use App\pengajuanak;
use PDF;

class AllDosenController extends Controller
{
    //All Dosen View
    public function lihat_jabatan()
    {
        $jabatanData= jabatan::all();
        return view('dosen.lihat_jabatan',compact('jabatanData'));
    }
     public function lihat_datasaya()
    {
        return view('dosen.data_saya');
    }
    public function lihat_kk()
    {
        $komponenkegiatanData= komponenkegiatan::all();
        return view('dosen.lihat_komponenkegiatan',compact('komponenkegiatanData'));
    }
    public function lihat_pengajuan()
    {

        $user = Auth::user();

            $pengajuanData = pengajuanak::where('dosen_id',$user->dosen->nip)->get();
            return view('dosen.lihat_datapengajuan',compact('pengajuanData'));
    }
    public function view_pengajuan()
    {
        // $dosenData = dosen::all();
        $jkData= DB::table('jeniskegiatans')->pluck("nama_jk","id");
        return view('dosen.create_pengajuan',compact('jkData'));
    }

    public function getKK($id)
    {
        $kk_id = DB::table("komponenkegiatans")->where("jk_id",$id)->pluck("nama_kegiatan","id");
        return json_encode($kk_id);
    }




    //Pengajuan Angka Kredit
    public function ajukan(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            // // 'kk_id' => ['required'],
            // 'file' => ['mimes:pdf|required'],
            ]);



            if($request->hasFile('file'))
            {
                $destination = "uploads/pdf";
                $filename = $request->file('file');
                $filename->move($destination, $filename->getClientOriginalName());
            }
            $user = Auth::user();
            $pengajuanData = new pengajuanak();
            $pengajuanData->dosen_id = $user->dosen->nip;
            $pengajuanData->kk_id = $request->kk_id;
            $pengajuanData->file = $filename->getClientOriginalName();
            $pengajuanData->save();

            return view ('dosen.create_pengajuan')->with(['success' => 'Pesan Berhasil']);
            // return view ('dosen.lihat_datapengajuan',array('pengajuanData' => pengajuanak::where('dosen_id',$user->dosen->nip)))->with('alert-success','Data berhasil ditambahkan !');
    }

    //Print PDF Data saya
    public function cetakpdf()
    {
        $user = Auth::user();
        $pengajuanData = pengajuanak::where('dosen_id',$user->dosen->nip)->where('status','=','1')->get();
        $pdf = PDF::loadview('dosen.report_pengajuan',compact('pengajuanData'));
        return $pdf->stream();
    }


}
