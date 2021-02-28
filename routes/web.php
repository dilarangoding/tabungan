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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

   Route::get('/dashboard', 'HomeController@dashboard');
    

//    tabungan
    Route::get('tabungan_masuk','HomeController@tabunganMasuk');
    Route::get('tabungan_keluar','HomeController@tabunganKeluar');
    Route::get('tabungan','HomeController@tabungan');

    Route::get('profile','HomeController@profile');
    Route::post('update/profile/{id}','HomeController@updateProfile');


    // export
    Route::get('report/tabungan','HomeController@reportTabungan');
    Route::get('report/tabunganMasuk','HomeController@reportTabunganMasuk');
    Route::get('report/tabunganKeluar','HomeController@reportTabunganKeluar');

    Route::group(['middleware'=>'IsAdmin'], function(){

    // Kelas
    Route::get('kelas','HomeController@kelas');
    Route::POST('add_kelas','HomeController@addKelas');
    Route::get('kelas/hapus/{id}','HomeController@deleteKelas');
    Route::get('kelas/edit/{id}','HomeController@editKelas');
    Route::post('kelas/update/{id}','HomeController@updateKelas');

    // siswa 

    Route::get('siswa','HomeController@siswa');
    Route::get('add_siswa','HomeController@addSiswa');
    Route::post('siswa/store','HomeController@storeSiswa');
    Route::get('siswa/edit/{id}','HomeController@editSiswa');
    Route::post('siswa/update/{id}','HomeController@updateSiswa');
    Route::get('siswa/hapus/{id}','HomeController@deleteSiswa');

    // tabungan
    

    // Tabungan Masuk
    Route::get('tabungan_masuk_admin','HomeController@tabunganMasukAdmin');
    Route::get('add_tabungan_masuk','HomeController@addTabunganMasuk');
    Route::post('tabungan_masuk/store','HomeController@storeTabunganMasuk');
    Route::get('tabungan_masuk/edit/{id}','HomeController@editTabunganMasuk');
    Route::post('tabungan_masuk/update/{id}','HomeController@updateTabunganMasuk');
    Route::get('tabungan_masuk/hapus/{id}','HomeController@deleteTabunganMasuk');


    // Tabungan Keluar

    Route::get('tabungan_keluar_admin','HomeController@tabunganKeluarAdmin');
    Route::get('add_tabungan_keluar','HomeController@addTabunganKeluar');
    Route::post('tabungan_keluar/store','HomeController@storeTabunganKeluar');
    Route::get('tabungan_keluar/hapus/{id}','HomeController@deleteTabunganKeluar');
    Route::get('tabungan_keluar/edit/{id}','HomeController@editTabunganKeluar');
    Route::post('tabungan_keluar/update/{id}','HomeController@updateTabunganKeluar');
    Route::get('getDetailSaldo/{id}','HomeController@getDetailSaldo');
});