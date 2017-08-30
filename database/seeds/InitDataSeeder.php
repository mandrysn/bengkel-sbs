<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Merek;
use App\Satuan;
use App\Suplier;
use App\Asuransi;
use App\Barang;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->UserSeeder();
        $this->MerekSeeder();
        $this->SatuanSeeder();
        $this->SuplierSeeder();
        $this->AsuransiSeeder();
        $this->BarangSeeder();
    }
    
    public function UserSeeder()
    {
        $data = [
            [
                'name'     => 'Alegria',
                'email'    => 'alg@gmail.com',
                'level'    => 'admin',
                'password' => bcrypt('admin213')
            ],
            [
                'name'     => 'User',
                'email'    => 'user@gmail.com',
                'level'    => 'user',
                'password' => bcrypt('user213')
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

    public function BarangSeeder()
    {
        DB::table('barangs');//->truncate();
        $data = [   
        [
        'merek_id'        => '1',
        'satuan_id'       => '1',
        'kode_barang'     => 'B0001',
        'no_part_barang'  => '101101',
        'nama_barang'     => 'Ban Dalam',
        'kategori_barang' => '2',
        'harga_barang'    => '85000',
        'keterangan'      => 'Barang Baru'
        ],
        [
        'merek_id'        => '2',
        'satuan_id'       => '1',
        'kode_barang'     => 'B0002',
        'no_part_barang'  => '202202',
        'nama_barang'     => 'Ban Luar',
        'kategori_barang' => '2',
        'harga_barang'    => '350000',
        'keterangan'      => 'Barang Baru'
        ],
        [
        'merek_id'        => '1',
        'satuan_id'       => '2',
        'kode_barang'     => 'B0003',
        'no_part_barang'  => '303303',
        'nama_barang'     => 'Oli Mesin',
        'kategori_barang' => '2',
        'harga_barang'    => '55000',
        'keterangan'      => 'Barang Baru'
        ],
        [
        'merek_id'        => '2',
        'satuan_id'       => '2',
        'kode_barang'     => 'B0004',
        'no_part_barang'  => '505505',
        'nama_barang'     => 'Lap Canebo',
        'kategori_barang' => '1',
        'harga_barang'    => '70000'
        ],
        [
            'merek_id'        => '2',
            'satuan_id'       => '2',
            'kode_barang'     => 'B0005',
            'no_part_barang'  => '606606',
            'nama_barang'     => 'Bantal Jok',
            'kategori_barang' => '1',
            'harga_barang'    => '70000'
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
            'so_transaksi_id'    => '1',
        'asuransi_id'         => '2',
        'no_claim'            => '19191919',
        'nama_pelanggan'      => 'Alegria',
        'alamat_pelanggan'    => 'Jl. Z Samarinda',
        'no_telpon_pelanggan' => '081346291112'
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
            'so_transaksi_id'    => '3',
        'merek_id' => '1',
        'warna_kendaraan' => 'Putih',
        'tahun_kendaraan' => '2014',
        'no_polisi'       => 'KT1800MN',
        'no_mesin'        => '671928831304',
        'no_rangka'       => 'ZD03192-C931',
        'km_kendaraan'    => '13000',
        'foto_depan'      => 'depan.jpg',
        'foto_belakang'   => 'belakang.jpg',
        'foto_kiri'       => 'kiri.jpg',
        'foto_kanan'      => 'kanan.jpg',
        'tanggal_masuk'   => '2017-07-27',
        'tanggal_selesai' => '2018-01-28'
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
