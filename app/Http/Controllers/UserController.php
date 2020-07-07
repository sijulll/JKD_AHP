<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Image;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function penilaiDashboard()
    {
        $users = User::all();
        return view('penilai.dashboard')->with('users','$users');
    }

    public function adminDashboard()
    {
        $users = User::all();
        return view('admin.dashboard')->with('users','$users');
    }

    public function aprofile()
    {
        return view ('a_profile',array('user' => Auth::user()));
    } public function pprofile()
    {
        return view ('p_profile',array('user' => Auth::user()));
    }
    // public function penilaiprofile()
    // {
    //     return view ('penilai_profile',array('user' => Auth::user()));
    // }
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function a_profileUpdate(Request $request)
    {
        // handle update user
        $this->validate($request, [
            'username' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:250', 'unique:users'],
            // 'image' => ['mimes:jpeg,jpg,png|required|max:10000'],
            ]);
        if($request->hasFile('img')){
            $img = $request->file('img');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ) );
        }
        $user = Auth::user();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image = $filename;
        $user->save();
        return view ('a_profile',array('user' => Auth::user()));
    }
    public function p_profileUpdate(Request $request, User $user)
    {
        // handle update user
        $this->validate($request, [
            'username' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:250', 'unique:users'],
            'image' => ['mimes:jpeg,jpg,png|required|max:10000'],
            ]);
        if($request->hasFile('image')){
            $img = $request->file('image');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ) );

            $user = Auth::user();
            $user->image = $filename;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            return view('profile', array('user' => Auth::user()) );;
        }
    }
    public function p_update(Request $request, User $user)
    {
        // handle update user

        $this->validate($request, [
            'username' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:250', 'unique:users'],
            'image' => ['mimes:jpeg,jpg,png|required|max:10000'],
            ]);
        if($request->$request->hasFile('image')){
            $img = $request->file('image');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ) );
        }
        $user = Auth::user();
        $user->image = $filename;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return view('profile', array('user' => Auth::user()) );;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
