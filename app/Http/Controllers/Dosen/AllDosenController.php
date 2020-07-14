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

class AllDosenController extends Controller
{
    //
    public function lihat_jabatan()
    {
        $jabatanData= jabatan::all();
        return view('dosen.lihat_jabatan',compact('jabatanData'));
    }
    public function lihat_kk()
    {
        $komponenkegiatanData= komponenkegiatan::all();
        return view('dosen.lihat_komponenkegiatan',compact('komponenkegiatanData'));
    }
    public function view_pengajuan()
    {
        $dosenData = dosen::all();
        $jkData= DB::table('jeniskegiatans')->pluck("nama_jk","id");
        return view('dosen.create_pengajuan',compact('jkData','dosenData'));
    }
    public function getKK($id)
    {
        $kk_id = DB::table("komponenkegiatans")->where("jk_id",$id)->pluck("nama_kegiatan","id");
        return json_encode($kk_id);
    }

    public function ajukan(Request $request, User $user)
    {
        $this->validate($request, [
            'dosen_id' => ['required'],
            'kk_id' => ['required'],
            'file' => ['mimes:pdf,|required'],
            ]);
            $user = Auth::user();
            if ($files = $request->file('file')) {
                $destinationPath = 'public/pdf/'. $user->dosen->nip; // upload path
                if(!File::isDirectory($destinationPath))
                {
                    File::makeDirectory($path, 0777, true, true);
                }

                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $insert['image'] = "$profileImage";
             }

             $insert['title'] = $request->get('title');
             $insert['product_code'] = $request->get('product_code');
             $insert['description'] = $request->get('description');

             Product::insert($request->all());

             return Redirect::to('products')
            ->with('success','Greate! Product created successfully.');
    }

}
