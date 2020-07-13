<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\komponenkegiatan;
use App\jeniskegiatan;
use App\User;
use App\dosen;
use Auth;
use DB;

class PengajuanController extends Controller
{
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
        return view('admin.pengajuan.data_pengajuan',compact('users','komponenkegiatanData','dosenData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function c()
    {
        return view('admin.pengajuan.pengajuan_c');
    }

    public function create()
    {
       $users = Auth::user();
       $jeniskegiatanData = jeniskegiatan::all();
        // $komponenkegiatanData = komponenkegiatan::all();
        $dosenData= dosen::all();
        return view('admin.pengajuan.create_pengajuan',compact('users','jeniskegiatanData','dosenData'));
    }
    function fetch(request $request)
    {
  	    //if our chosen id and products table prod_cat_id col match the get first 100 data

        //$request->id here is the id of our chosen option id
        $data=komponenkegiatan::select('nama_kegiatan','id')->where('jk_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function s(Request $request)
     {

        $rules = array(
            'jk_id.*'  => 'required',
            'kk_id.*'  => 'required',
           );
           $error = Validator::make($request->all(), $rules);
           if($error->fails())
           {
            return response()->json([
             'error'  => $error->errors()->all()
            ]);
           }

           $first_name = $request->first_name;
           $last_name = $request->last_name;
           for($count = 0; $count < count($first_name); $count++)
           {
            $data = array(
             'first_name' => $first_name[$count],
             'last_name'  => $last_name[$count]
            );
            $insert_data[] = $data;
           }

           DynamicField::insert($insert_data);
           return response()->json([
            'success'  => 'Data Added successfully.'
           ]);

     }
    public function store(Request $request)
    {

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
