<?php

use Illuminate\Database\Seeder;

class MasterKomposisiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master__komposisi')->delete();
        
        \DB::table('master__komposisi')->insert(array (
            0 => 
            array (
                'id_komposisi' => 1,
                'id_produk' => 'PR130120-001',
                'id_bb' => 'BB130120-017',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 9000.0,
                'tgl_register' => '2020-01-13 16:07:17',
            ),
            1 => 
            array (
                'id_komposisi' => 2,
                'id_produk' => 'PR130120-001',
                'id_bb' => 'BB130120-020',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 10000.0,
                'tgl_register' => '2020-01-13 16:07:31',
            ),
            2 => 
            array (
                'id_komposisi' => 3,
                'id_produk' => 'PR130120-001',
                'id_bb' => 'BB130120-011',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 11000.0,
                'tgl_register' => '2020-01-13 16:10:10',
            ),
            3 => 
            array (
                'id_komposisi' => 4,
                'id_produk' => 'PR130120-001',
                'id_bb' => 'BB130120-012',
                'jumlah' => 3.0,
                'rasio' => '0.1',
                'harga_bahan' => 30000.0,
                'tgl_register' => '2020-01-13 16:11:08',
            ),
            4 => 
            array (
                'id_komposisi' => 5,
                'id_produk' => 'PR130120-001',
                'id_bb' => 'BB130120-007',
                'jumlah' => 1.0,
                'rasio' => '0.5',
                'harga_bahan' => 120000.0,
                'tgl_register' => '2020-01-13 16:12:26',
            ),
            5 => 
            array (
                'id_komposisi' => 6,
                'id_produk' => 'PR130120-002',
                'id_bb' => 'BB130120-010',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 15000.0,
                'tgl_register' => '2020-01-13 16:12:49',
            ),
            6 => 
            array (
                'id_komposisi' => 7,
                'id_produk' => 'PR130120-002',
                'id_bb' => 'BB130120-013',
                'jumlah' => 1.0,
                'rasio' => '0.5',
                'harga_bahan' => 15000.0,
                'tgl_register' => '2020-01-13 16:13:26',
            ),
            7 => 
            array (
                'id_komposisi' => 8,
                'id_produk' => 'PR130120-002',
                'id_bb' => 'BB130120-006',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 50000.0,
                'tgl_register' => '2020-01-13 16:13:46',
            ),
            8 => 
            array (
                'id_komposisi' => 9,
                'id_produk' => 'PR130120-002',
                'id_bb' => 'BB130120-002',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 6500.0,
                'tgl_register' => '2020-01-13 16:14:23',
            ),
        ));
        
        
    }
}