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
    Route::get('pre-so/cari/asuransi', 'PreSoController@cariAsuransi')->name('pre-so.cari.asuransi');
    Route::get('pre-so/cari/pelanggan', 'PreSoController@cariPelanggan')->name('pre-so.cari.pelanggan');
    Route::resource('pre-so', 'PreSoController');
    Route::resource('so-detail', 'SoDetailController');
    Route::resource('rekap-preso', 'RekapController');
    Route::resource('print-preso', 'PrintController');

    Route::resource('cari-so', 'CariController');
    Route::resource('rekap-so', 'RekapController');
    Route::resource('print-so', 'PrintController');
    Route::get('servis-order/cari/spk', 'SoTransaksiController@cariSpk')->name('servis-order.cari.spk');
    Route::resource('servis-order', 'SoTransaksiController');

    Route::resource('ganti-part', 'ChangePartController');

    Route::resource('cari-kendaraan', 'CariController');
    Route::resource('cari-pelanggan', 'CariController');
    Route::resource('pelanggan', 'SoPelangganController');
    Route::resource('kendaraan', 'SoKendaraanController');
    Route::resource('transaksi-jasa', 'SoTransaksiJasaController');
    Route::resource('transaksi-barang', 'SoTransaksiBarangController');

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

    Route::get('laporan/pdfmerek/', 'LaporanController@pdfmerek')->name('pdfmerek');
    Route::get('laporan/pdfbarang/', 'LaporanController@pdfbarang')->name('pdfbarang');
    Route::get('laporan/pdfsuplier/', 'LaporanController@pdfsuplier')->name('pdfsuplier');
    Route::get('laporan/pdfasuransi/', 'LaporanController@pdfasuransi')->name('pdfasuransi');
    Route::get('laporan/pdfpelanggan/', 'LaporanController@pdfpelanggan')->name('pdfpelanggan');
    Route::get('laporan/pdfkendaraan/', 'LaporanController@pdfkendaraan')->name('pdfkendaraan');
    Route::resource('laporan', 'LaporanController');
    
});

//Auth::routes();
    // Authentication Routes...
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
