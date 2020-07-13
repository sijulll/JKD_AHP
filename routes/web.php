<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::get('/','UserController@index');
route::get('/c','Admin\PengajuanController@c');
route::post('/s','Admin\PengajuanController@s');

Auth::routes();
Route::get('/admindashboard' ,'UserController@adminDashboard')->name('admin.dashboard')->middleware('admin');
Route::get('/penilaidashboard' ,'UserController@penilaiDashboard')->name('penilai.dashboard')->middleware('penilai');
Route::get('/dosendashboard' ,'UserController@dosenDashboard')->name('dosen.dashboard')->middleware('dosen');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/aprofile','UserController@aprofile')->name('get.aprofile')->middleware('admin');
Route::post('/aprofile','UserController@a_profileUpdate')->name('aprofile')->middleware('admin');
Route::get('/pprofile','UserController@pprofile')->name('get.pprofile')->middleware('penilai');
Route::post('/pprofile','UserController@p_profileUpdate')->name('aprofile')->middleware('penilai');
Route::get('/dd1','Admin\PengajuanController@fetch');



//Grouping Admin
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin'],'as'=>'admin.'], function(){
Route::resource('jabatan', 'JabatanController');
Route::resource('kriteria', 'KriteriaController');
Route::resource('jeniskegiatan', 'JenisKegiatanController');
Route::resource('komponenkegiatan', 'KomponenKegiatanController');
Route::resource('role', 'RoleController');
Route::resource('dosen', 'DosenController');
Route::resource('pengajuan', 'PengajuanController');
});

//Grouping Penilai
Route::group(['prefix'=>'penilai','namespace'=>'Penilai','middleware'=>['auth','penilai'],'as'=>'penilai.'], function(){
Route::resource('approval', 'ApprovalController');
});

//Grouping Dosen
Route::group(['prefix'=>'penilai','namespace'=>'Penilai','middleware'=>['auth','penilai'],'as'=>'penilai.'], function(){
Route::resource('approval', 'ApprovalController');
});
