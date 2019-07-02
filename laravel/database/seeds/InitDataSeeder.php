<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Merek;
use App\Satuan;
use App\Suplier;
use App\Asuransi;
use App\Barang;
use App\Operasional;
use App\Modul;
use App\Group;
use App\SoPelanggan;
use App\SoKendaraan;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->ModulSeeder();
        $this->GroupSeeder();
        $this->UserSeeder();
        $this->MerekSeeder();
        $this->SatuanSeeder();
        $this->SuplierSeeder();
        $this->AsuransiSeeder();
        $this->BarangSeeder();
        $this->SoPelangganSeeder();
        $this->SoKendaraanSeeder();
        $this->OperasionalSeeder();
    }
    public function ModulSeeder()
    {
        $data = [
            // Asuransi
            [ 'nama_modul' => 'Asuransi Index' ],[ 'nama_modul' => 'Asuransi Tambah' ],[ 'nama_modul' => 'Asuransi Detail' ],[ 'nama_modul' => 'Asuransi Ubah' ],[ 'nama_modul' => 'Asuransi Hapus' ],
            // Barang
            [ 'nama_modul' => 'Barang Index' ],[ 'nama_modul' => 'Barang Tambah' ],[ 'nama_modul' => 'Barang Detail' ],[ 'nama_modul' => 'Barang Ubah' ],[ 'nama_modul' => 'Barang Hapus' ],
            // Modul Barang Keluar & Bukti Keluar & List Barang Keluar
            [ 'nama_modul' => 'BBK Index' ],[ 'nama_modul' => 'BBK Tambah' ],[ 'nama_modul' => 'BBK Detail' ],[ 'nama_modul' => 'BBK Ubah' ],[ 'nama_modul' => 'BBK Hapus' ],
            // Modul Barang Masuk & Bukti Material & List Barang Masuk
            [ 'nama_modul' => 'BBM Index' ],[ 'nama_modul' => 'BBM Tambah' ],[ 'nama_modul' => 'BBM Detail' ],[ 'nama_modul' => 'BBM Ubah' ],[ 'nama_modul' => 'BBM Hapus' ],
            // Modul Pre Invoice & List Barang dan Jasa Pre Invoice
            [ 'nama_modul' => 'Pre-Invoice Index' ],[ 'nama_modul' => 'Pre-Invoice Tambah' ],[ 'nama_modul' => 'Pre-Invoice Detail' ],[ 'nama_modul' => 'Pre-Invoice Ubah' ],[ 'nama_modul' => 'Pre-Invoice Hapus' ],
            // Modul Group
            [ 'nama_modul' => 'Group Index' ],[ 'nama_modul' => 'Group Tambah' ],[ 'nama_modul' => 'Group Detail' ],[ 'nama_modul' => 'Group Ubah' ],[ 'nama_modul' => 'Group Hapus' ],
            // Modul Jejak Pelanggan
            [ 'nama_modul' => 'Jejak Pelanggan Index' ],[ 'nama_modul' => 'Jejak Pelanggan Tambah' ],[ 'nama_modul' => 'Jejak Pelanggan Detail'],[ 'nama_modul' => 'Jejak Pelanggan Ubah ' ],[ 'nama_modul' => 'Jejak Pelanggan Hapus' ],
            // Modul Pemesanan Material & List Pemesanan
            [ 'nama_modul' => 'Material Index' ],[ 'nama_modul' => 'Material Tambah' ],[ 'nama_modul' => 'Material Detail' ],[ 'nama_modul' => 'Material Ubah' ],[ 'nama_modul' => 'Material Hapus' ],
            // merek
            [ 'nama_modul' => 'Merek Index' ],[ 'nama_modul' => 'Merek Tambah' ],[ 'nama_modul' => 'Merek Detail' ],[ 'nama_modul' => 'Merek Ubah' ],[ 'nama_modul' => 'Merek Hapus' ],
            // Modul Operasional
            [ 'nama_modul' => 'Operasional Index' ],[ 'nama_modul' => 'Operasional Tambah' ],[ 'nama_modul' => 'Operasional Detail' ],[ 'nama_modul' => 'Operasional Ubah' ],[ 'nama_modul' => 'Operasional Hapus' ],
            // Modul Pemasukan
            [ 'nama_modul' => 'Pemasukan Index' ],[ 'nama_modul' => 'Pemasukan Tambah' ],[ 'nama_modul' => 'Pemasukan Detail' ],[ 'nama_modul' => 'Pemasukan Ubah' ],[ 'nama_modul' => 'Pemasukan Hapus' ],
            // Modul Pemesanan Barang & List Pemesanan Barang
            [ 'nama_modul' => 'Pemesanan Barang Index' ],[ 'nama_modul' => 'Pemesanan Barang Tambah' ],[ 'nama_modul' => 'Pemesanan Barang Detail' ],[ 'nama_modul' => 'Pemesanan Barang Ubah' ],[ 'nama_modul' => 'Pemesanan Barang Hapus' ],
            // Modul Pengeluaran
            [ 'nama_modul' => 'Pengeluaran Index' ],[ 'nama_modul' => 'Pengeluaran Tambah' ],[ 'nama_modul' => 'Pengeluaran Detail' ],[ 'nama_modul' => 'Pengeluaran Ubah' ],[ 'nama_modul' => 'Pengeluaran Hapus' ],
            // Modul Pengguna (User)
            [ 'nama_modul' => 'Pengguna Index' ],[ 'nama_modul' => 'Pengguna Tambah' ],[ 'nama_modul' => 'Pengguna Detail' ],[ 'nama_modul' => 'Pengguna Ubah' ],[ 'nama_modul' => 'Pengguna Hapus' ],
            // Modul Pre SO
            [ 'nama_modul' => 'Pre-SO Index' ],[ 'nama_modul' => 'Pre-SO Tambah' ],[ 'nama_modul' => 'Pre-SO Detail' ],[ 'nama_modul' => 'Pre-SO Ubah' ],[ 'nama_modul' => 'Pre-SO Hapus' ],
            // satuan
            [ 'nama_modul' => 'Satuan Index' ],[ 'nama_modul' => 'Satuan Tambah' ],[ 'nama_modul' => 'Satuan Detail' ],[ 'nama_modul' => 'Satuan Ubah' ],[ 'nama_modul' => 'Satuan Hapus' ],
            // Modul Kendaraan
            [ 'nama_modul' => 'Kendaraan Index' ],[ 'nama_modul' => 'Kendaraan Tambah' ],[ 'nama_modul' => 'Kendaraan Detail' ],[ 'nama_modul' => 'Kendaraan Ubah' ],[ 'nama_modul' => 'Kendaraan Hapus' ],
            // Modul Pelanggan
            [ 'nama_modul' => 'Pelanggan Index' ],[ 'nama_modul' => 'Pelanggan Tambah' ],[ 'nama_modul' => 'Pelanggan Detail' ],[ 'nama_modul' => 'Pelanggan Ubah' ],[ 'nama_modul' => 'Pelanggan Hapus' ],
            // Modul SO
            [ 'nama_modul' => 'Servis Order Index' ],[ 'nama_modul' => 'Servis Order Tambah' ],[ 'nama_modul' => 'Servis Order Detail' ],[ 'nama_modul' => 'Servis Order Ubah' ],[ 'nama_modul' => 'Servis Order Hapus' ],
            // Supplier
            [ 'nama_modul' => 'Supplier Index' ],[ 'nama_modul' => 'Supplier Tambah' ],[ 'nama_modul' => 'Supplier Detail' ],[ 'nama_modul' => 'Supplier Ubah' ],[ 'nama_modul' => 'Supplier Hapus' ],
            // Modul Tagihan
            [ 'nama_modul' => 'Tagihan Index' ],[ 'nama_modul' => 'Tagihan Tambah' ],[ 'nama_modul' => 'Tagihan Detail' ],[ 'nama_modul' => 'Tagihan Ubah' ],[ 'nama_modul' => 'Tagihan Hapus' ],
            // Modul Tagihan OR
            [ 'nama_modul' => 'TagihanOR Index' ],[ 'nama_modul' => 'TagihanOR Tambah' ],[ 'nama_modul' => 'TagihanOR' ],[ 'nama_modul' => 'TagihanOR Ubah' ],[ 'nama_modul' => 'TagihanOR Hapus' ],
        ];
        
        foreach($data as $modul){
            Modul::create($modul);
        }
    }
    public function GroupSeeder()
    {
        $data = [
            [
                'id'            => '1',
                'nama_group'     => 'Admin'
            ],
            [
                'id'            => '2',
                'nama_group'     => 'Operator'
            ]
        ];
        
        foreach($data as $group){
            Group::create($group);
        }
    }
    public function UserSeeder()
    {
        $data = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@gmail.com',
                'level'    => 'admin',
                'password' => bcrypt('admin123'),
                'group_id' => '1'
            ],
            [
                'name'     => 'User',
                'email'    => 'user@gmail.com',
                'level'    => 'user',
                'password' => bcrypt('user123'),
                'group_id' => '2'
            ]
        ];
        
        foreach($data as $user){
            User::create($user);
        }
    }
    public function MerekSeeder()
    {
        DB::table('mereks');//->truncate();
        $data = [
        [
        'kode_merek' => 'M0001',
        'nama_merek' => 'Toyota',
        'unit_merek' => 'Avanza'
        ],
        [
        'kode_merek' => 'M0002',
        'nama_merek' => 'Toyota',
        'unit_merek' => 'Yaris'
        ],
        [
        'kode_merek' => 'M0003',
        'nama_merek' => 'Mitsubishi',
        'unit_merek' => 'Pajjero/Sport'
        ],
        [
        'kode_merek' => 'M0004',
        'nama_merek' => 'Honda',
        'unit_merek' => 'C-RV'
        ],
        [
        'kode_merek' => 'M0005',
        'nama_merek' => 'Honda',
        'unit_merek' => 'Jazz'
        ]
            ];
        

        foreach ($data as $merek) {
             Merek::create($merek);
        }
    }
    
    public function SatuanSeeder()
    {
        DB::table('satuans');//->truncate();
        $data = array(
        [
        'kode_satuan' => 'Pcs',
        'nama_satuan' => 'Pieces'
        ],
        [
        'kode_satuan' => 'Klg',
        'nama_satuan' => 'Kaleng'
        ],
        [
        'kode_satuan' => 'Btl',
        'nama_satuan' => 'Botol'
        ]);

        foreach ($data as $satuan) {
             Satuan::create($satuan);
        }   
    }

    public function AsuransiSeeder()
    {
        DB::table('asuransis');//->truncate();
        $data = array(
        [
        'kode_asuransi'      => 'AS001',
        'nama_asuransi'      => 'PT. ABC',
        'alamat_asuransi'    => 'Jl. A Samarinda',
        'no_telpon_asuransi' => '0541756703',
        'no_hp_asuransi'     => '081346291112'
        ],
        [
        'kode_asuransi'      => 'AS002',
        'nama_asuransi'      => 'PT. XYZ',
        'alamat_asuransi'    => 'Jl. B Samarinda',
        'no_telpon_asuransi' => '0541626101',
        'no_hp_asuransi'     => ''
        ],
        [
        'kode_asuransi'      => 'AS003',
        'nama_asuransi'      => 'PT. KLM',
        'alamat_asuransi'    => 'Jl. C Samarinda',
        'no_telpon_asuransi' => '0541763121',
        'no_hp_asuransi'     => '081149023162'
        ]);

        foreach ($data as $asuransi) {
             Asuransi::create($asuransi);
        }   
    }
    
    public function SuplierSeeder()
    {
        DB::table('supliers');//->truncate();
        $data = array(
        [
        'kode_suplier'      => 'SP001',
        'nama_suplier'      => 'UD. ABC',
        'alamat_suplier'    => 'Jl. Z Samarinda',
        'no_telpon_suplier' => '0541756703',
        'no_hp_suplier'     => '081346291112'
        ],
        [
        'kode_suplier'      => 'SP002',
        'nama_suplier'      => 'CV. XYZ',
        'alamat_suplier'    => 'Jl. Y Samarinda',
        'no_telpon_suplier' => '0541626101',
        'no_hp_suplier'     => ''
        ],
        [
        'kode_suplier'      => 'SP003',
        'nama_suplier'      => 'CV. KLM',
        'alamat_suplier'    => 'Jl. X Samarinda',
        'no_telpon_suplier' => '0541763121',
        'no_hp_suplier'     => '081149023162'
        ]);

        foreach ($data as $suplier) {
             Suplier::create($suplier);
        }   
    }

    public function OperasionalSeeder()
    {
        DB::table('operasionals');//->truncate();
        $data = [
        [
            'nama_operasional'      => 'Bayar Listrik'
        ],
        [
            'nama_operasional'      => 'Bayar Telpon'
        ],
        [
            'nama_operasional'      => 'Bayar Air'
        ],
        [
            'nama_operasional' => 'Bayar Gaji'
        ],
        [
            'nama_operasional' => 'Arisan Antar Bengkel'
        ]
        ];

        foreach ($data as $operasional) {
             Operasional::create($operasional);
        }   
    }

    public function BarangSeeder()
    {
        DB::table('barangs');//->truncate();
        $data = [   
        [
        'merek_id'        => '1',
        'satuan_id'       => '1',
        'kode_barang'     => 'B000001',
        'no_part_barang'  => '101101',
        'nama_barang'     => 'Ban Dalam',
        'kategori_barang' => '2',
        'harga_beli'    => '85000',
        'harga_jual'    => '95000',
        'keterangan'      => 'Barang Baru',
        'status'          => '1'
        ],
        [
        'merek_id'        => '2',
        'satuan_id'       => '1',
        'kode_barang'     => 'B000002',
        'no_part_barang'  => '202202',
        'nama_barang'     => 'Ban Luar',
        'kategori_barang' => '2',
        'harga_beli'    => '350000',
        'harga_jual'    => '450000',
        'keterangan'      => 'Barang Baru',
        'status'          => '1'
        ],
        [
        'merek_id'        => '1',
        'satuan_id'       => '2',
        'kode_barang'     => 'B000003',
        'no_part_barang'  => '303303',
        'nama_barang'     => 'Oli Mesin',
        'kategori_barang' => '2',
        'harga_beli'    => '55000',
        'harga_jual'    => '65000',
        'keterangan'      => 'Barang Baru',
        'status'          => '1'
        ],
        [
        'merek_id'        => '2',
        'satuan_id'       => '2',
        'kode_barang'     => 'B000004',
        'no_part_barang'  => '505505',
        'nama_barang'     => 'Lap Canebo',
        'kategori_barang' => '1',
        'harga_beli'    => '70000',
        'harga_jual'    => '80000',
        'status'          => '1'
        ],
        [
            'merek_id'        => '2',
            'satuan_id'       => '2',
            'kode_barang'     => 'B000005',
            'no_part_barang'  => '606606',
            'nama_barang'     => 'Bantal Jok',
            'kategori_barang' => '1',
            'harga_beli'    => '70000',
            'harga_jual'    => '80000',
            'status'          => '1'
            ]
        ];

        foreach ($data as $barang) {
             Barang::create($barang);
        }   
    }
    
    public function SoPelangganSeeder()
    {
        DB::table('so_pelanggans');//->truncate();
        $data = [
        [
        'asuransi_id'         => '1',
        'no_claim'            => '6432220001',
        'nama_pelanggan'      => 'JUMILAH',
        'alamat_pelanggan'    => 'SAMARINDA',
        'no_telpon_pelanggan' => '081346291112'
        ],
        [
            'asuransi_id'         => '2',
            'no_claim'            => '7432220002',
            'nama_pelanggan'      => 'ANDIANSYAH',
            'alamat_pelanggan'    => 'SAMARINDA',
            'no_telpon_pelanggan' => '081226292112'
        ],
        [
            'asuransi_id'         => '3',
            'no_claim'            => '9432220211',
            'nama_pelanggan'      => 'SENDI',
            'alamat_pelanggan'    => 'BALIKPAPAN',
            'no_telpon_pelanggan' => '085346291122'
        ]
        ];

        foreach ($data as $sopelanggan) {
             SoPelanggan::create($sopelanggan);
        }   
    }

    public function SoKendaraanSeeder()
    {
        DB::table('so_kendaraans');//->truncate();
        $data = [
        [
        'so_pelanggan_id'    => '2',
        'merek_id' => '1',
        'warna_kendaraan' => 'Putih',
        'tahun_kendaraan' => '2014',
        'no_polisi'       => 'KT 1800 MN',
        'no_mesin'        => '671928831304',
        'no_rangka'       => 'ZD03192-C931',
        'km_kendaraan'    => '13000',
        'foto_depan'      => null
        ],
        [
            'so_pelanggan_id'    => '2',
            'merek_id' => '3',
            'warna_kendaraan' => 'Putih',
            'tahun_kendaraan' => '2014',
            'no_polisi'       => 'KT 1551 ZAN',
            'no_mesin'        => '9121928831334',
            'no_rangka'       => 'ZD02392-C871',
            'km_kendaraan'    => '23000',
            'foto_depan'      => null
        ],
        [
            'so_pelanggan_id'    => '1',
            'merek_id' => '4',
            'warna_kendaraan' => 'Merah',
            'tahun_kendaraan' => '2017',
            'no_polisi'       => 'B 5801 JK',
            'no_mesin'        => '521958831304',
            'no_rangka'       => 'FG03192-C931',
            'km_kendaraan'    => '40000',
            'foto_depan'      => null
        ],
        [
            'so_pelanggan_id'    => '3',
            'merek_id' => '1',
            'warna_kendaraan' => 'Silver',
            'tahun_kendaraan' => '2017',
            'no_polisi'       => 'KT 6800 KK',
            'no_mesin'        => '567766831304',
            'no_rangka'       => 'KL03192-B931',
            'km_kendaraan'    => '20000',
            'foto_depan'      => null
            ]
        ];

        foreach ($data as $sokendaraan) {
             SoKendaraan::create($sokendaraan);
        }   
    }
    
    public function SoTransaksiSeeder()
    {
        DB::table('so_transaksis');//->truncate();
        $data = [
        [
        'no_transaksi' => 'SBS2017-SO00001',
        'tanggal_masuk' => '2017-08-30'
        ]
        ];

        foreach ($data as $sotransaksi) {
             SoTransaksi::create($sotransaksi);
        }   
    }
    public function SoTransaksiBarangSeeder()
    {
        DB::table('so_transaksi_barangs');//->truncate();
        $data = [
        [
        'so_transaksi_id'    => '1',
        'kategori_transaksi' => '2',
        'barang_id'          => '1',
        'quantity'           => '1',
        'harga_transaksi'    => '0',
        'keterangan'         => ''
        ],
        [
        'so_transaksi_id'    => '1',
        'kategori_transaksi' => '2',
        'barang_id'          => '2',
        'quantity'           => '1',
        'harga_transaksi'    => '0',
        'keterangan'         => ''
        ],
        [
        'so_transaksi_id'    => '1',
        'kategori_transaksi' => '2',
        'barang_id'          => '3',
        'quantity'           => '1',
        'harga_transaksi'    => '0',
        'keterangan'         => ''
        ],
        [
        'so_transaksi_id'    => '2',
        'kategori_transaksi' => '2',
        'barang_id'          => '2',
        'quantity'           => '1',
        'harga_transaksi'    => '0',
        'keterangan'         => ''
        ],
        [
        'so_transaksi_id'    => '2',
        'kategori_transaksi' => '2',
        'barang_id'          => '3',
        'quantity'           => '1',
        'harga_transaksi'    => '0',
        'keterangan'         => ''
        ],
        [
        'so_transaksi_id'    => '3',
        'kategori_transaksi' => '2',
        'barang_id'          => '1',
        'quantity'           => '1',
        'harga_transaksi'    => '0',
        'keterangan'         => 'Oli Mesin'
        ]
            ];

        foreach ($data as $sotransaksibarang) {
             SoTransaksiBarang::create($sotransaksibarang);
        }
    }
    public function SoTransaksiJasaSeeder()
    {
        DB::table('so_transaksi_jasas');//->truncate();
        $data = array(
        [
        'so_transaksi_id' => '1',
        'kategori_transaksi' => '1',
        'kegiatan'        => 'Ganti Ban Dalam',
        'quantity'        => '1',
        'harga_transaksi' => '0',
        'keterangan'      => 'Ban Bridgestone'
        ],
        [
        'so_transaksi_id' => '1',
        'kategori_transaksi' => '1',
        'kegiatan'        => 'Ganti Oli Mesin',
        'quantity'        => '1',
        'harga_transaksi' => '0',
        'keterangan'      => 'Oli Mesin'
        ],
        [
        'so_transaksi_id' => '2',
        'kategori_transaksi' => '1',
        'kegiatan'        => 'Ganti Oli Mesin',
        'quantity'        => '1',
        'harga_transaksi' => '0',
        'keterangan'      => 'Oli Mesin'
        ],
        [
        'so_transaksi_id' => '3',
        'kategori_transaksi' => '1',
        'kegiatan'        => 'Ganti Ban Luar',
        'quantity'        => '1',
        'harga_transaksi' => '0',
        'keterangan'      => 'Ganti Ban Luar'
        ],
        [
        'so_transaksi_id'    => '3',
        'kategori_transaksi' => '1',
        'kegiatan'           => 'Ganti Oli Mesin',
        'quantity'           => '1',
        'harga_transaksi'    => '0',
        'keterangan'         => 'Oli Mesin'
        ]);

        foreach ($data as $sotransaksijasa) {
             SoTransaksiJasa::create($sotransaksijasa);
        }
    }

}
