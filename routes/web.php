<?php

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
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return "Cache is cleared";
});

// Route::get('/home', 'HomeController@index_umum');
Route::get('/', 'HomeController@index_umum');
Route::get('/cek_lokasi', 'HomeController@index_lokasi');
Route::get('/view_data_home', 'LokasiController@view_data_home');
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    
    
    Route::get('tanaman', 'LokasiController@index_tanaman');
    Route::get('lokasi', 'LokasiController@index');
    Route::get('lokasi/cetak/{id}', 'LokasiController@cetak');
    Route::get('lokasi/ubah/{id}', 'LokasiController@ubah');
    Route::get('tanaman/ubah/{id}', 'LokasiController@ubah_tanaman');
    Route::get('lokasi/cek/{id}', 'LokasiController@cek');
    Route::get('lokasi/uncek/{id}', 'LokasiController@uncek');
    Route::get('lokasi/kirim_email/{id}', 'LokasiController@kirim_email');
    Route::get('lokasi/hapus/{id}', 'LokasiController@hapus');
    Route::get('tanaman/hapus/{id}', 'LokasiController@hapus_tanaman');
    Route::get('lokasi/view_data', 'LokasiController@view_data');
    Route::get('tanaman/view_data', 'LokasiController@view_data_tanaman');
    Route::get('lokasi/view_data_2', 'LokasiController@view_data_2');
    
    Route::post('lokasi/simpan', 'LokasiController@simpan');
    Route::post('tanaman/simpan', 'LokasiController@simpan_tanaman');
    Route::post('lokasi/ubah_data', 'LokasiController@ubah_data');
    Route::post('tanaman/ubah_data', 'LokasiController@ubah_data_tanaman');

});


Auth::routes();


