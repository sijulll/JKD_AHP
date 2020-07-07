<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\kriteria;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteriaData= kriteria::all();
        return view('admin.ahp.kriteria.kriteria_crd',compact('kriteriaData'));
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
        $kriteriaData = new kriteria();
        $kriteriaData->nama_kriteria = $request->nama_kriteria;
        $kriteriaData->bobot = $request->bobot;
        $kriteriaData->save();
        return redirect()->route('admin.kriteria.index')->with('alert-success','Data berhasil ditambahkan !');
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
        $kriteriaData = kriteria::where('id',$id)->get();
        return view('admin.ahp.kriteria.kriteria_edit',compact('kriteriaData'));
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
        $kriteriaData = kriteria::where('id',$id)->first();
        $kriteriaData->nama_kriteria = $request->nama_kriteria;
        $kriteriaData->bobot = $request->bobot;
        $kriteriaData->save();
        return redirect()->route('admin.kriteria.index')->with('alert-success','data berhasil diubah.');
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
        $kriteriaData =kriteria::where('id',$id)->first();
        $kriteriaData->delete();
        return redirect()->route('admin.kriteria.index')->with('alert-success','Data berhasil dihapus.');
    }
}
