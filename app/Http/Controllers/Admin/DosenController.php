<?php

namespace App\Http\Controllers\Admin;

use App\dosen;
use App\jabatan;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ValidatesRequests;
use DB;
use Hash;
class DosenController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $dosenData= dosen::all();
        return view('admin.dosen.dosen_read',compact('dosenData'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $jabatanData = jabatan::all();
        return view('admin.dosen.dosen_create',compact(('jabatanData')));
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
            'email' => 'email|unique:users|min:4',
            'nama_dosen' => 'required|max:255',
            'alamat' => 'required',
            'no_tlp' => 'numeric|regex:/^([0-9\s\-\+\(\)]*)$/|digits:12',
            'j_id' => 'required',
            'nip' => 'min:4',
            'mulai_menjabat' => 'required'
        ],
    [
        'email.unique' => 'Email Sudah terpakai',
        'nama_dosen.max' => 'Maximal Character 255 untuk nama dosen',
        'no_tlp.integer' => 'Nomor telpon harus angka',
        'no_tlp.digits' => 'Maximal nomor telpon adalah 12 digit',
    ]);

        $userData = new user();
        $userData->username = $request->username;
        $userData->email = $request->email;
        $userData->password = hash::make($request->password);
        $userData->role_id  = 3;
        $userData->save();

        $id = DB::getPdo()->lastInsertId();;

        $dosenData = new dosen();
        $dosenData->nip = $request->nip;
        $dosenData->user_id = $id;
        $dosenData->nama_dosen = $request->nama_dosen;
        $dosenData->alamat = $request->alamat;
        $dosenData->no_tlp = $request->no_tlp;
        $dosenData->j_id = $request->j_id;
        $dosenData->mulai_menjabat = $request->mulai_menjabat;
        $dosenData->save();
        return redirect()->route('admin.dosen.index')->with('alert-success','Data berhasil ditambahkan !');
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
        $dosenData = dosen::where('nip',$id)->get();
        $jabatanData= jabatan::all();
        return view('admin.dosen.dosen_edit',compact('dosenData','jabatanData'));
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
            'nama_dosen' => 'required|max:255',
            'alamat' => 'required',
            'no_tlp' => 'numeric|regex:/^([0-9\s\-\+\(\)]*)$/|digits:12',
            'j_id' => 'required',
            'mulai_menjabat' => 'required'
        ],
    [
        'nama_dosen.max' => 'Maximal Character 255 untuk nama dosen',
        'no_tlp.integer' => 'Nomor telpon harus angka',
        'no_tlp.digits' => 'Maximal nomor telpon adalah 12 digit',
    ]);



        $dosenData = dosen::where('nip',$id)->first();
        $dosenData->nama_dosen = $request->nama_dosen;
        $dosenData->alamat = $request->alamat;
        $dosenData->no_tlp = $request->no_tlp;
        $dosenData->j_id = $request->j_id;
        $dosenData->mulai_menjabat = $request->mulai_menjabat;
        $dosenData->save();
        return redirect()->route('admin.dosen.index')->with('alert-success','Data berhasil ditambah');
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
        $dosenData = dosen::where('nip',$id)->first();
        $dosenData->delete();
        return redirect()->route('admin.dosen.index')->with('alert-success','Data berhasil dihapus.');
    }

}
