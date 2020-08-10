<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\jabatan;
use Redirect,Response;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all data from jabatan Controller
        $jabatanData= jabatan::all();
        return view('admin.jabatan.jabatan_crud',compact('jabatanData'));
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
        $request->validate([
            'nama_jabatan' => 'max:250',
            'kum' => 'numeric'

        ],
    [
        'nama_jabatan.max' => 'Maximal Huruf adalah 250',
        'kum.numeric' => 'Point Kum Hanya boleh angka',
    ]);
        $jabatanData = new jabatan();
        $jabatanData->nama_jabatan = $request->nama_jabatan;
        $jabatanData->kum = $request->kum;
        $jabatanData->save();
        return redirect()->route('admin.jabatan.index')->with('alert-success','Data berhasil ditambahkan !');
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
        //melemparkan id ke page edit
        $jabatanData = jabatan::where('id',$id)->get();
        return view('admin.jabatan.jabatan_edit',compact('jabatanData'));
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
        $request->validate([
            'nama_jabatan' => 'max:250',
            'kum' => 'numeric'

        ],
    [
        'nama_jabatan.max' => 'Maximal Huruf adalah 250',
        'kum.numeric' => 'Point Kum Hanya boleh angka',
    ]);
        // update data yang telah di dapat dari fungsi edit diatas
        $jabatanData = jabatan::where('id',$id)->first();
        $jabatanData->nama_jabatan = $request->nama_jabatan;
        $jabatanData->kum = $request->kum;
        $jabatanData->save();
        return redirect()->route('admin.jabatan.index')->with('alert-success','data berhasil diubah.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data pada table jabatan
        $jabatanData =jabatan::where('id',$id)->first();
        $jabatanData->delete();
        return redirect()->route('admin.jabatan.index')->with('alert-success','Data berhasil dihapus.');
    }

}
