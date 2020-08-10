<?php

namespace App\Http\Controllers\Penilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\jabatan;
use App\pengajuanak;
use App\komponenkegiatan;
use DB;
class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lihat_kk()
    {
        $komponenkegiatanData= komponenkegiatan::all();
        return view('penilai.lihat_komponenkegiatan',compact('komponenkegiatanData'));
    }
    public function lihat_jabatan()
    {
        $jabatanData= jabatan::all();
        return view('penilai.lihat_jabatan',compact('jabatanData'));
    }
    public function detail($id)
    {
        $pengajuanData = pengajuanak::where('dosen_id',$id)->get();
        return view('penilai.detail_approval',compact('pengajuanData'));
    }
    public function index()
    {
        // $pengajuanData = Db::table('pengajuanaks')->select('id','dosen_id')->groupBy('id','dosen_id')->orderBy('created_at')->get();
        $pengajuanData = Db::table('pengajuanaks')->join('dosens','pengajuanaks.dosen_id','=','dosens.nip')
        ->select('pengajuanaks.id','pengajuanaks.dosen_id','dosens.nama_dosen')
        ->groupby('dosen_id')->orderby('pengajuanaks.created_at','asc')->get();

        return view('penilai.approval',compact('pengajuanData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengajuanData = pengajuanak::where('id',$id)->get();
        return view('penilai.lihat_dataapproval',compact('pengajuanData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dosenData = pengajuanak::where('id',$id)->first();
        $dosenData->note = $request->note;
        $dosenData->status = $request->status;
        $dosenData->save();
        return redirect()->route('penilai.approval.index')->with('alert-success','Data berhasil di verifikasi dan akan di lanjutkan ke dosen bersangkutan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
