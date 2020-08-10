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

Auth::routes();
Route::get('/' ,'UserController@index');
Route::get('/admindashboard' ,'UserController@adminDashboard')->name('admin.dashboard')->middleware('admin');
Route::get('/penilaidashboard' ,'UserController@penilaiDashboard')->name('penilai.dashboard')->middleware('penilai');
Route::get('/dosendashboard' ,'UserController@dosenDashboard')->name('dosen.dashboard')->middleware('dosen');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/aprofile','UserController@aprofile')->name('get.aprofile');
Route::post('/aprofile','UserController@a_profileUpdate')->name('aprofile');
//Grouping Admin
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin'],'as'=>'admin.'], function(){
Route::resource('jabatan', 'JabatanController');
Route::resource('kriteria', 'KriteriaController');
Route::resource('jeniskegiatan', 'JenisKegiatanController');
Route::resource('komponenkegiatan', 'KomponenKegiatanController');
Route::resource('role', 'RoleController');
Route::resource('dosen', 'DosenController');
route::get('/admin/log-dosen','LogAktifitasController@getLogDosen')->name('admin.logDosen');
route::get('/admin/log-penilai','LogAktifitasController@getLogPenilai')->name('admin.logPenilai');
});
//Grouping Penilai
Route::group(['prefix'=>'penilai','namespace'=>'Penilai','middleware'=>['auth','penilai'],'as'=>'penilai.'], function(){
Route::resource('approval', 'ApprovalController');
Route::get('/penilai/approval','ApprovalController@index')->name('penilai.approval');
Route::get('/penilai/approval-detail/{id}','ApprovalController@detail')->name('penilai.approval.detail');
Route::get('/penilai/lihat-data/{id}','ApprovalController@edit')->name('penilai.edit');
Route::get('/dosen/lihatjabatan','ApprovalController@lihat_jabatan')->name('penilai.lihatjabatan');
Route::get('/dosen/lihatkomponenkegiatan','ApprovalController@lihat_kk')->name('penilai.lihatkomponenkegiatan');
});
//Grouping Dosen
Route::group(['prefix'=>'dosen','namespace'=>'Dosen','middleware'=>['auth','dosen'],'as'=>'dosen.'], function(){
Route::get('/dosen/lihatjabatan','AllDosenController@lihat_jabatan')->name('dosen.lihatjabatan');
Route::get('/dosen/lihatkomponenkegiatan','AllDosenController@lihat_kk')->name('dosen.lihatkomponenkegiatan');
Route::get('/dosen/pengajuan-angka-kredit','AllDosenController@view_pengajuan')->name('dosen.pengajuan');
Route::get('/dosen/pengajuan/getKK/{id}','AllDosenController@getKK');
Route::get('/dosen/lihat-data-pengajuan','AllDosenController@lihat_pengajuan')->name('dosen.lihatpengajuan');
Route::post('/dosen/ajukan','AllDosenController@ajukan')->name('dosen.ajukan');
Route::get('/dosen/data-saya/{id}','AllDosenController@lihat_datasaya')->name('dosen.datasaya');
// Route::get('/dosen/kelayakan/{id}','AllDosenController@lihat_kelayakan')->name('dosen.kelayakan');
Route::get('/dosen/pdf','AllDosenController@cetakpdf')->name('dosen.pdf');
});
