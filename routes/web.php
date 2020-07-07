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

Route::get('/', function () {
    return redirect('login');
    Route::get('admin/datapengajuandosen','PengajuanController@index');
});

Auth::routes();

Route::get('/admindashboard' ,'UserController@adminDashboard')->name('admin.dashboard')->middleware('admin');
Route::get('/penilaidashboard' ,'UserController@penilaiDashboard')->name('penilai.dashboard')->middleware('penilai');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/aprofile','UserController@aprofile')->name('get.aprofile')->middleware('admin');
Route::post('/aprofile','UserController@a_profileUpdate')->name('aprofile')->middleware('admin');
Route::get('/pprofile','UserController@pprofile')->name('get.pprofile')->middleware('penilai');
Route::post('/pprofile','UserController@p_profileUpdate')->name('aprofile')->middleware('penilai');



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

//Grouping Admin
Route::group(['prefix'=>'penilai','namespace'=>'Penilai','middleware'=>['auth','penilai'],'as'=>'penilai.'], function(){
Route::resource('approval', 'ApprovalController');
});
