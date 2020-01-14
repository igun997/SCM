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
                'stok' => 27.0,
                'deskripsi' => 'Set Pembersih Sepatu Ukuran Kecil',
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'harga_produksi' => 99000.0,
                'harga_distribusi' => 118800.0,
                'tgl_register' => '2020-01-13 16:05:24',
                'tgl_perubahan' => NULL,
            ),
            1 => 
            array (
                'id_produk' => 'PR130120-002',
                'nama_produk' => 'Set Pembersih Sabuk',
                'stok_minimum' => 100.0,
                'stok' => 40.0,
                'deskripsi' => 'Set Pembersih',
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'harga_produksi' => 79000.0,
                'harga_distribusi' => 94800.0,
                'tgl_register' => '2020-01-13 16:06:39',
                'tgl_perubahan' => NULL,
            ),
        ));
        
        
    }
}