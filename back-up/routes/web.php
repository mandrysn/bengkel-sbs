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

    Route::get('pre-so/cari', 'PreSoController@cari');
    Route::get('pre-so/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'PreSoController@pdfview']);
    Route::resource('pre-so', 'PreSoController');
    Route::resource('so-detail', 'SoDetailController');
    Route::resource('rekap-preso', 'RekapPreSoController');

    Route::get('servis-order/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'SoTransaksiController@pdfview']);
    Route::get('servis-order/cari', 'SoTransaksiController@cari');
    Route::resource('servis-order', 'SoTransaksiController');

    Route::resource('ganti-part', 'ChangePartController');

    Route::get('kendaraan/cari', 'SoKendaraanController@cari');
    Route::get('pelanggan/cari', 'SoPelangganController@cari');
    Route::resource('pelanggan', 'SoPelangganController');
    Route::resource('kendaraan', 'SoKendaraanController');
    Route::resource('transaksi-jasa', 'SoTransaksiJasaController');
    Route::resource('transaksi-barang', 'SoTransaksiBarangController');

    Route::get('ekstimasi/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'EkstimasiController@pdfview']);
    Route::get('ekstimasi/cari', 'EkstimasiController@cari');
    Route::resource('ekstimasi', 'EkstimasiController');
    Route::resource('ekstimasi-ppn', 'EkstimasiPpnController');
    Route::resource('rekap-pre-invoice', 'RekapPreSoController');
    
    Route::resource('ekstimasi-jasa', 'EkstimasiJasaController');
    Route::resource('ekstimasi-barang', 'EkstimasiBarangController');

    Route::get('order-barang/cari', 'PemesananBarangController@cari');
    Route::get('order-barang/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'PemesananBarangController@pdfview']);
    Route::resource('order-barang', 'PemesananBarangController');
    Route::resource('transaksi-order', 'PemesananBarangDetailController');

    Route::get('order-material/cari', 'MaTransaksiController@cari');
    Route::get('order-material/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'MaTransaksiController@pdfview']);
    Route::resource('order-material', 'MaTransaksiController');
    Route::resource('transaksi-material', 'MaTransaksiDetailController');
    
    Route::get('barang-masuk/cari', 'BarangMasukController@cari');
    Route::get('barang-masuk/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'BarangMasukController@pdfview']);
    Route::resource('barang-masuk', 'BarangMasukController');
    Route::resource('detail-barang-masuk', 'BarangMasukDetailController');

    Route::resource('bukti-material', 'BuktiMaterialController');
    Route::get('bukti-material/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'BuktiMaterialController@pdfview']);
    Route::resource('detail-bukti-material', 'BuktiMaterialDetailController');

    Route::get('barang-keluar/cari', 'BarangKeluarController@cari');
    Route::get('barang-keluar/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'BarangKeluarController@pdfview']);
    Route::resource('barang-keluar', 'BarangKeluarController');

    Route::get('bukti-keluar/cari', 'BuktiKeluarController@cari');
    Route::get('bukti-keluar/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'BuktiKeluarController@pdfview']);
    Route::resource('bukti-keluar', 'BuktiKeluarController');

    Route::resource('pengeluaran', 'PengeluaranController');
    Route::resource('pemasukan', 'PemasukanController');

    Route::get('tagihan/cari', 'TagihanController@cari');
    Route::get('tagihan/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'TagihanController@pdfview']);
    Route::resource('tagihan', 'TagihanController');

    Route::get('tagihan-or/cari', 'TagihanOrController@cari');
    Route::get('tagihan-or/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'TagihanOrController@pdfview']);
    Route::resource('tagihan-or', 'TagihanOrController');
    
    Route::get('jejak-pelanggan/cari', 'JejakPelangganController@cari');
    Route::resource('jejak-pelanggan', 'JejakPelangganController');
    Route::resource('rekap-jejak', 'RekapPreSoController');

    Route::get('operasional/cari', 'OperasionalController@cari');
    Route::resource('operasional', 'OperasionalController');

    Route::get('gudang/cari', 'GudangController@cari');
    Route::resource('gudang', 'GudangController');
    
    Route::get('user', 'UserController@index')->name('user.store');
    Route::post('user', 'UserController@store')->name('user.store');

    Route::get('pengguna/cari', 'UserController@cari');
    Route::resource('pengguna', 'PenggunaController');

    Route::get('group/cari', 'GroupController@cari');
    Route::resource('group', 'GroupController');

    Route::get('laporan/pdfmerek/', ['as' => 'pdfmerek', 'uses' => 'LaporanController@pdfmerek']);
    Route::get('laporan/pdfbarang/', ['as' => 'pdfbarang', 'uses' => 'LaporanController@pdfbarang']);
    Route::get('laporan/pdfasuransi/', ['as' => 'pdfasuransi', 'uses' => 'LaporanController@pdfasuransi']);
    Route::get('laporan/pdfsuplier/', ['as' => 'pdfsuplier', 'uses' => 'LaporanController@pdfsuplier']);
    Route::get('laporan/pdfso/', ['as' => 'pdfso', 'uses' => 'LaporanController@pdfso']);
    Route::get('laporan/pdfpelanggan/', ['as' => 'pdfpelanggan', 'uses' => 'LaporanController@pdfso']);
    Route::resource('laporan', 'LaporanController');
    
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