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
    Route::resource('saldo', 'SaldoController');

    Route::resource('cari-merek', 'CariController');
    Route::resource('merek', 'MerekController');
    
    Route::resource('cari-satuan', 'CariController');
    Route::resource('satuan', 'SatuanController');

    Route::resource('cari-barang', 'CariController');
    Route::resource('barang', 'BarangController');

    Route::resource('cari-asuransi', 'CariController');
    Route::resource('asuransi', 'AsuransiController');

    Route::resource('cari-suplier', 'CariController');
    Route::resource('suplier', 'SuplierController');

    Route::resource('cari-preso', 'CariController');
    Route::resource('pre-so', 'PreSoController');
    Route::resource('so-detail', 'SoDetailController');
    Route::resource('rekap-preso', 'RekapController');
    Route::resource('print-preso', 'PrintController');

    Route::resource('cari-so', 'CariController');
    Route::resource('servis-order', 'SoTransaksiController');
    Route::resource('rekap-so', 'RekapController');
    Route::resource('print-so', 'PrintController');

    Route::resource('ganti-part', 'ChangePartController');

    Route::resource('cari-kendaraan', 'CariController');
    Route::resource('cari-pelanggan', 'CariController');
    Route::resource('pelanggan', 'SoPelangganController');
    Route::resource('kendaraan', 'SoKendaraanController');
    Route::resource('transaksi-jasa', 'SoTransaksiJasaController');
    Route::resource('transaksi-barang', 'SoTransaksiBarangController');

    //Route::get('ekstimasi/{id}/pdfview/', ['as' => 'pdfview', 'uses' => 'EkstimasiController@pdfview']);
    Route::resource('cari-ekstimasi', 'CariController');
    Route::resource('ekstimasi', 'EkstimasiController');
    Route::resource('ekstimasi-ppn', 'EkstimasiPpnController');
    Route::resource('rekap-pre-invoice', 'RekapController');
    Route::resource('print-pre-invoice', 'PrintController');
    
    Route::resource('ekstimasi-jasa', 'EkstimasiJasaController');
    Route::resource('ekstimasi-barang', 'EkstimasiBarangController');

    Route::resource('cari-order-barang', 'CariController');
    Route::resource('order-barang', 'PemesananBarangController');
    Route::resource('transaksi-order', 'PemesananBarangDetailController');
    Route::resource('rekap-order-barang', 'RekapController');
    Route::resource('print-order-barang', 'PrintController');

    Route::resource('po', 'PoController');

    Route::resource('cari-order-material', 'CariController');
    Route::resource('order-material', 'MaTransaksiController');
    Route::resource('transaksi-material', 'MaTransaksiDetailController');
    Route::resource('rekap-order-material', 'RekapController');
    Route::resource('print-order-material', 'PrintController');
    
    // Route::get('barang-masuk/cari', 'BarangMasukController@cari');
    // Route::resource('barang-masuk', 'BarangMasukController');
    // Route::resource('detail-barang-masuk', 'BarangMasukDetailController');
    // Route::resource('rekap-barang-masuk', 'RekapController');
    // Route::resource('print-barang-masuk', 'PrintController');

    // Route::get('bukti-material/cari', 'BuktiMaterialController@cari');
    // Route::resource('bukti-material', 'BuktiMaterialController');
    // Route::resource('detail-bukti-material', 'BuktiMaterialDetailController');
    // Route::resource('rekap-bukti-material', 'RekapController');
    // Route::resource('print-bukti-material', 'PrintController');

    // Route::get('barang-keluar/cari', 'BarangKeluarController@cari');
    // Route::resource('barang-keluar', 'BarangKeluarController');
    // Route::resource('detail-barang-keluar', 'BarangKeluarDetailController');
    // Route::resource('rekap-barang-keluar', 'RekapController');
    // Route::resource('print-barang-keluar', 'PrintController');

    // Route::get('bukti-keluar/cari', 'BuktiKeluarController@cari');
    // Route::resource('bukti-keluar', 'BuktiKeluarController');
    // Route::resource('detail-bukti-keluar', 'BuktiKeluarDetailController');
    // Route::resource('rekap-bukti-keluar', 'RekapController');
    // Route::resource('print-bukti-keluar', 'PrintController');

    Route::resource('cari-pengeluaran', 'CariController');
    Route::resource('pengeluaran', 'PengeluaranController');
    Route::resource('rekap-pengeluaran', 'RekapController');
    Route::resource('print-pengeluaran', 'PrintController');

    Route::resource('cari-pemasukan', 'CariController');
    Route::resource('pemasukan', 'PemasukanController');
    Route::resource('rekap-pemasukan', 'RekapController');

    Route::resource('cari-invoice', 'CariController');
    Route::resource('tagihan', 'TagihanController');
    Route::resource('rekap-invoice', 'RekapController');
    Route::resource('print-invoice', 'PrintController');

    Route::resource('cari-tagihan-or', 'CariController');
    Route::resource('tagihan-or', 'TagihanOrController');
    Route::resource('rekap-tagihan-or', 'RekapController');
    Route::resource('print-tagihan-or', 'PrintController');
    
    Route::resource('cari-jejak-pelanggan', 'CariController');
    Route::resource('jejak-pelanggan', 'JejakPelangganController');
    Route::resource('rekap-jejak', 'RekapController');

    Route::resource('cari-operasional', 'CariController');
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
    Route::get('laporan/pdfpelanggan/', ['as' => 'pdfpelanggan', 'uses' => 'LaporanController@pdfpelanggan']);
    Route::get('laporan/pdfkendaraan/', ['as' => 'pdfkendaraan', 'uses' => 'LaporanController@pdfkendaraan']);
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