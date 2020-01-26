<?php

use Illuminate\Database\Seeder;

class MasterProdukTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master__produk')->delete();
        
        \DB::table('master__produk')->insert(array (
            0 => 
            array (
                'id_produk' => 'PR130120-001',
                'nama_produk' => 'Set Pembersih Sepatu',
                'stok_minimum' => 100.0,
                'stok' => 58.0,
                'deskripsi' => 'Set Pembersih Sepatu Ukuran Kecil',
                'kadaluarsa' => NULL,
                'id_satuan' => 9,
                'harga_produksi' => 103000.0,
                'harga_distribusi' => 113300.0,
                'tgl_register' => '2020-01-13 16:05:24',
                'tgl_perubahan' => '2020-01-25',
            ),
            1 => 
            array (
                'id_produk' => 'PR130120-002',
                'nama_produk' => 'Set Pembersih Sabuk',
                'stok_minimum' => 100.0,
                'stok' => 18.0,
                'deskripsi' => 'Set Pembersih',
                'kadaluarsa' => NULL,
                'id_satuan' => 9,
                'harga_produksi' => 81500.0,
                'harga_distribusi' => 89650.0,
                'tgl_register' => '2020-01-13 16:06:39',
                'tgl_perubahan' => '2020-01-25',
            ),
            2 => 
            array (
                'id_produk' => 'PR250120-003',
                'nama_produk' => 'Set Pembersih Dompet',
                'stok_minimum' => 50.0,
                'stok' => 38.0,
                'deskripsi' => 'Set Pembersih Untuk Dompet',
                'kadaluarsa' => NULL,
                'id_satuan' => 9,
                'harga_produksi' => 64000.0,
                'harga_distribusi' => 70400.0,
                'tgl_register' => '2020-01-25 22:21:13',
                'tgl_perubahan' => '2020-01-25',
            ),
            3 => 
            array (
                'id_produk' => 'PR250120-004',
                'nama_produk' => 'Set Pembersih Tas',
                'stok_minimum' => 0.0,
                'stok' => 0.0,
                'deskripsi' => 'Set Untuk Pembersihan Tas',
                'kadaluarsa' => NULL,
                'id_satuan' => 9,
                'harga_produksi' => 130500.0,
                'harga_distribusi' => 156600.0,
                'tgl_register' => '2020-01-25 22:22:14',
                'tgl_perubahan' => NULL,
            ),
            4 => 
            array (
                'id_produk' => 'PR250120-005',
                'nama_produk' => 'Set Pembersih Helm',
                'stok_minimum' => 0.0,
                'stok' => 40.0,
                'deskripsi' => 'Set Untuk Pembersih Helm',
                'kadaluarsa' => NULL,
                'id_satuan' => 9,
                'harga_produksi' => 61500.0,
                'harga_distribusi' => 73800.0,
                'tgl_register' => '2020-01-25 22:22:32',
                'tgl_perubahan' => NULL,
            ),
        ));
        
        
    }
}