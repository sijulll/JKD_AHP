<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\jeniskegiatan;

class JenisKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jeniskegiatanData= jeniskegiatan::all();
        return view('admin.jeniskegiatan.jeniskegiatan_crd',compact('jeniskegiatanData'));
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
        $jeniskegiatanData = new jeniskegiatan();
        $jeniskegiatanData->nama_jk = $request->nama_jk;
        $jeniskegiatanData->deskripsi = $request->deskripsi;
        $jeniskegiatanData->save();
        return redirect()->route('admin.jeniskegiatan.index')->with('alert-success','Data berhasil ditambahkan !');
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
        $jeniskegiatanData = jeniskegiatan::where('id',$id)->get();
        return view('admin.jeniskegiatan.jeniskegiatan_edit',compact('jeniskegiatanData'));

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
        $jeniskegiatanData = jeniskegiatan::where('id',$id)->first();
        $jeniskegiatanData->nama_jk = $request->nama_jk;
        $jeniskegiatanData->deskripsi = $request->deskripsi;
        $jeniskegiatanData->save();
        return redirect()->route('admin.jeniskegiatan.index')->with('alert-success','data berhasil diubah.');

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
        $jeniskegiatanData =jeniskegiatan::where('id',$id)->first();
        $jeniskegiatanData->delete();
        return redirect()->route('admin.jeniskegiatan.index')->with('alert-success','Data berhasil dihapus.');
    }
}
