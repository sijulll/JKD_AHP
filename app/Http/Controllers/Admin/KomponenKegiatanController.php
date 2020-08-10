<?php

namespace App\Http\Controllers\Admin;

use App\jeniskegiatan;
use App\komponenkegiatan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KomponenKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $komponenkegiatanData= komponenkegiatan::all();
        $jeniskegiatanData= jeniskegiatan::all();
        return view('admin.komponenkegiatan.komponenkegiatan_crd',compact('komponenkegiatanData','jeniskegiatanData'));
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
        $request->validate([
            'jk_id' => 'required',
            'nama_kegiatan' => 'required',
            'kegiatan_point' => 'required',
        ]);

        $komponenkegiatanData = new komponenkegiatan();
        $komponenkegiatanData->jk_id = $request->jk_id;
        $komponenkegiatanData->nama_kegiatan = $request->nama_kegiatan;
        $komponenkegiatanData->kegiatan_point = $request->kegiatan_point;
        $komponenkegiatanData->deskripsi = $request->deskripsi;
        $komponenkegiatanData->save();
        return redirect()->route('admin.komponenkegiatan.index')->with('alert-success','Data berhasil ditambahkan !');
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
        //
        $komponenkegiatanData = komponenkegiatan::where('id',$id)->get();
        $jeniskegiatanData= jeniskegiatan::all();
        return view('admin.komponenkegiatan.komponenkegiatan_edit',compact('komponenkegiatanData','jeniskegiatanData'));
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
        //
        $komponenkegiatanData = komponenkegiatan::where('id',$id)->first();
        $komponenkegiatanData->jk_id = $request->jk_id;
        $komponenkegiatanData->nama_kegiatan = $request->nama_kegiatan;
        $komponenkegiatanData->kegiatan_point = $request->kegiatan_point;
        $komponenkegiatanData->deskripsi = $request->deskripsi;
        $komponenkegiatanData->save();
        return redirect()->route('admin.komponenkegiatan.index')->with('alert-success', 'Data Berhasil Diubah');
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
        $komponenkegiatanData =komponenkegiatan::where('id',$id)->first();
        $komponenkegiatanData->delete();
        return redirect()->route('admin.komponenkegiatan.index')->with('success','Data berhasil dihapus.');
    }
}
