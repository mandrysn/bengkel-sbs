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


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('index', 'HomeController@index');

    Route::get('merek/cari', 'MerekController@cari');
    Route::resource('merek', 'MerekController');
    
    Route::get('satuan/cari', 'SatuanController@cari');
    Route::resource('satuan', 'SatuanController');

    Route::get('barang/cari', 'BarangController@cari');
    Route::resource('barang', 'BarangController');

    Route::get('asuransi/cari', 'AsuransiController@cari');
    Route::resource('asuransi', 'AsuransiController');

    Route::get('suplier/cari', 'SuplierController@cari');
    Route::resource('suplier', 'SuplierController');

    Route::resource('servis-order', 'SoTransaksiController');
    Route::resource('transaksi-jasa', 'SoTransaksiJasaController');
    Route::resource('transaksi-barang', 'SoTransaksiBarangController');

    Route::resource('pelanggan-order', 'SoPelangganController');
    Route::resource('kendaraan-order', 'SoKendaraanController');

    Route::get('ekstimasi/cari', 'EkstimasiController@cari');
    Route::resource('ekstimasi', 'EkstimasiController');
    
    Route::resource('ekstimasi-jasa', 'EkstimasiJasaController');
    Route::resource('ekstimasi-barang', 'EkstimasiBarangController');

    Route::get('order-barang/cari', 'PemesananBarangController@cari');
    Route::get('order-barang/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'PemesananBarangController@pdfview']);
    Route::resource('order-barang', 'PemesananBarangController');
    Route::resource('transaksi-order', 'PemesananBarangDetailController');

    Route::get('order-material/cari', 'MaTransaksiController@cari');
    Route::get('order-material/{order_material}/pdfview/', 'MaTransaksiController@pdfview')->name('order-material.pdfview');
    Route::resource('order-material', 'MaTransaksiController');
    Route::resource('transaksi-material', 'MaTransaksiDetailController');
    
    Route::resource('barang-masuk', 'BarangMasukController');
    Route::resource('detail-barang-masuk', 'BarangMasukDetailController');

    Route::resource('barang-keluar', 'BarangKeluarController');

    Route::resource('tagihan', 'TagihanController');
    
    
    Route::get('user', 'UserController@index')->name('user.store');
    Route::post('user', 'UserController@store')->name('user.store');
    
});

//Auth::routes();
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
//    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');