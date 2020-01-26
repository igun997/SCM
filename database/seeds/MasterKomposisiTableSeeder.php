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
                'id_komposisi' => 8,
                'id_produk' => 'PR130120-002',
                'id_bb' => 'BB130120-006',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 50000.0,
                'tgl_register' => '2020-01-13 16:13:46',
            ),
            7 => 
            array (
                'id_komposisi' => 9,
                'id_produk' => 'PR130120-002',
                'id_bb' => 'BB130120-002',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 6500.0,
                'tgl_register' => '2020-01-13 16:14:23',
            ),
            8 => 
            array (
                'id_komposisi' => 10,
                'id_produk' => 'PR130120-002',
                'id_bb' => 'BB130120-021',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 10000.0,
                'tgl_register' => '2020-01-25 22:20:04',
            ),
            9 => 
            array (
                'id_komposisi' => 11,
                'id_produk' => 'PR130120-001',
                'id_bb' => 'BB130120-019',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 4000.0,
                'tgl_register' => '2020-01-25 22:20:33',
            ),
            10 => 
            array (
                'id_komposisi' => 12,
                'id_produk' => 'PR250120-003',
                'id_bb' => 'BB130120-004',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 25000.0,
                'tgl_register' => '2020-01-25 22:22:51',
            ),
            11 => 
            array (
                'id_komposisi' => 13,
                'id_produk' => 'PR250120-003',
                'id_bb' => 'BB130120-019',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 4000.0,
                'tgl_register' => '2020-01-25 22:23:07',
            ),
            12 => 
            array (
                'id_komposisi' => 14,
                'id_produk' => 'PR250120-003',
                'id_bb' => 'BB130120-020',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 10000.0,
                'tgl_register' => '2020-01-25 22:23:19',
            ),
            13 => 
            array (
                'id_komposisi' => 15,
                'id_produk' => 'PR250120-003',
                'id_bb' => 'BB130120-010',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 15000.0,
                'tgl_register' => '2020-01-25 22:24:35',
            ),
            14 => 
            array (
                'id_komposisi' => 16,
                'id_produk' => 'PR250120-003',
                'id_bb' => 'BB130120-014',
                'jumlah' => 1.0,
                'rasio' => '0.5',
                'harga_bahan' => 20000.0,
                'tgl_register' => '2020-01-25 22:24:58',
            ),
            15 => 
            array (
                'id_komposisi' => 17,
                'id_produk' => 'PR250120-004',
                'id_bb' => 'BB130120-004',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 25000.0,
                'tgl_register' => '2020-01-25 22:25:32',
            ),
            16 => 
            array (
                'id_komposisi' => 18,
                'id_produk' => 'PR250120-004',
                'id_bb' => 'BB130120-014',
                'jumlah' => 1.0,
                'rasio' => '0.5',
                'harga_bahan' => 20000.0,
                'tgl_register' => '2020-01-25 22:25:45',
            ),
            17 => 
            array (
                'id_komposisi' => 19,
                'id_produk' => 'PR250120-004',
                'id_bb' => 'BB130120-024',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 14000.0,
                'tgl_register' => '2020-01-25 22:26:08',
            ),
            18 => 
            array (
                'id_komposisi' => 20,
                'id_produk' => 'PR250120-004',
                'id_bb' => 'BB130120-002',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 6500.0,
                'tgl_register' => '2020-01-25 22:26:22',
            ),
            19 => 
            array (
                'id_komposisi' => 21,
                'id_produk' => 'PR250120-004',
                'id_bb' => 'BB130120-006',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 50000.0,
                'tgl_register' => '2020-01-25 22:26:41',
            ),
            20 => 
            array (
                'id_komposisi' => 22,
                'id_produk' => 'PR250120-004',
                'id_bb' => 'BB130120-018',
                'jumlah' => 1.0,
                'rasio' => '0.5',
                'harga_bahan' => 50000.0,
                'tgl_register' => '2020-01-25 22:27:14',
            ),
            21 => 
            array (
                'id_komposisi' => 23,
                'id_produk' => 'PR250120-005',
                'id_bb' => 'BB130120-010',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 15000.0,
                'tgl_register' => '2020-01-25 22:27:35',
            ),
            22 => 
            array (
                'id_komposisi' => 24,
                'id_produk' => 'PR250120-005',
                'id_bb' => 'BB130120-011',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 11000.0,
                'tgl_register' => '2020-01-25 22:27:45',
            ),
            23 => 
            array (
                'id_komposisi' => 25,
                'id_produk' => 'PR250120-005',
                'id_bb' => 'BB130120-014',
                'jumlah' => 10.0,
                'rasio' => '0.01',
                'harga_bahan' => 20000.0,
                'tgl_register' => '2020-01-25 22:27:59',
            ),
            24 => 
            array (
                'id_komposisi' => 26,
                'id_produk' => 'PR250120-005',
                'id_bb' => 'BB130120-002',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 6500.0,
                'tgl_register' => '2020-01-25 22:28:16',
            ),
            25 => 
            array (
                'id_komposisi' => 27,
                'id_produk' => 'PR250120-005',
                'id_bb' => 'BB130120-016',
                'jumlah' => 1.0,
                'rasio' => '1',
                'harga_bahan' => 27000.0,
                'tgl_register' => '2020-01-25 22:28:30',
            ),
        ));
        
        
    }
}