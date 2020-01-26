<?php

use Illuminate\Database\Seeder;

class MasterBbTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master__bb')->delete();
        
        \DB::table('master__bb')->insert(array (
            0 => 
            array (
                'id_bb' => 'BB130120-001',
                'nama' => 'Sabun Cuci Piring Attar',
                'stok' => 92.0,
                'stok_minimum' => 10.0,
                'harga' => 9000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 4,
                'tgl_register' => '2020-01-13 15:38:15',
            ),
            1 => 
            array (
                'id_bb' => 'BB130120-002',
                'nama' => 'Vanish',
                'stok' => 86.0,
                'stok_minimum' => 10.0,
                'harga' => 6500.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 3,
                'tgl_register' => '2020-01-13 15:39:42',
            ),
            2 => 
            array (
                'id_bb' => 'BB130120-003',
                'nama' => 'HCL',
                'stok' => 100.0,
                'stok_minimum' => 2.0,
                'harga' => 6500.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 4,
                'tgl_register' => '2020-01-13 15:42:23',
            ),
            3 => 
            array (
                'id_bb' => 'BB130120-004',
            'nama' => 'Sikat standart (nylon)',
                'stok' => 0.0,
                'stok_minimum' => 10.0,
                'harga' => 25000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 1,
                'tgl_register' => '2020-01-13 15:49:53',
            ),
            4 => 
            array (
                'id_bb' => 'BB130120-005',
            'nama' => 'Sikat premium (bulu kuda)',
                'stok' => 100.0,
                'stok_minimum' => 10.0,
                'harga' => 38000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 1,
                'tgl_register' => '2020-01-13 15:50:09',
            ),
            5 => 
            array (
                'id_bb' => 'BB130120-006',
                'nama' => 'Lap microfiber',
                'stok' => 26.0,
                'stok_minimum' => 10.0,
                'harga' => 50000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 8,
                'tgl_register' => '2020-01-13 15:50:32',
            ),
            6 => 
            array (
                'id_bb' => 'BB130120-007',
                'nama' => 'Shoes cleaner',
                'stok' => 27.5,
                'stok_minimum' => 10.0,
                'harga' => 120000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 4,
                'tgl_register' => '2020-01-13 15:51:04',
            ),
            7 => 
            array (
                'id_bb' => 'BB130120-008',
                'nama' => 'Shoes parfum',
                'stok' => 100.0,
                'stok_minimum' => 5.0,
                'harga' => 100000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 13,
                'tgl_register' => '2020-01-13 15:55:30',
            ),
            8 => 
            array (
                'id_bb' => 'BB130120-009',
                'nama' => 'Sikat gigi',
                'stok' => 100.0,
                'stok_minimum' => 7.0,
                'harga' => 15000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 9,
                'tgl_register' => '2020-01-13 15:55:47',
            ),
            9 => 
            array (
                'id_bb' => 'BB130120-010',
                'nama' => 'Wadah',
                'stok' => 59.0,
                'stok_minimum' => 8.0,
                'harga' => 15000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 1,
                'tgl_register' => '2020-01-13 15:56:01',
            ),
            10 => 
            array (
                'id_bb' => 'BB130120-011',
                'nama' => 'Sikat suede',
                'stok' => 15.0,
                'stok_minimum' => 8.0,
                'harga' => 11000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 1,
                'tgl_register' => '2020-01-13 15:56:35',
            ),
            11 => 
            array (
                'id_bb' => 'BB130120-012',
                'nama' => 'H202',
                'stok' => 56.5,
                'stok_minimum' => 4.0,
                'harga' => 30000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 4,
                'tgl_register' => '2020-01-13 15:56:51',
            ),
            12 => 
            array (
                'id_bb' => 'BB130120-013',
                'nama' => 'Bibit Parfum',
                'stok' => 77.5,
                'stok_minimum' => 8.0,
                'harga' => 15000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 5,
                'tgl_register' => '2020-01-13 15:57:05',
            ),
            13 => 
            array (
                'id_bb' => 'BB130120-014',
                'nama' => 'Rinso bubuk',
                'stok' => 48.5,
                'stok_minimum' => 8.0,
                'harga' => 20000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 2,
                'tgl_register' => '2020-01-13 15:57:21',
            ),
            14 => 
            array (
                'id_bb' => 'BB130120-015',
                'nama' => 'hairdriyer',
                'stok' => 100.0,
                'stok_minimum' => 9.0,
                'harga' => 90000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 1,
                'tgl_register' => '2020-01-13 15:57:45',
            ),
            15 => 
            array (
                'id_bb' => 'BB130120-016',
                'nama' => 'kuas',
                'stok' => 60.0,
                'stok_minimum' => 8.0,
                'harga' => 27000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 9,
                'tgl_register' => '2020-01-13 15:58:03',
            ),
            16 => 
            array (
                'id_bb' => 'BB130120-017',
                'nama' => 'sikat dalam sepatu',
                'stok' => 55.0,
                'stok_minimum' => 8.0,
                'harga' => 9000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 1,
                'tgl_register' => '2020-01-13 15:58:19',
            ),
            17 => 
            array (
                'id_bb' => 'BB130120-018',
                'nama' => 'soda api',
                'stok' => 83.0,
                'stok_minimum' => 7.0,
                'harga' => 50000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 4,
                'tgl_register' => '2020-01-13 15:58:38',
            ),
            18 => 
            array (
                'id_bb' => 'BB130120-019',
                'nama' => 'sikat semir',
                'stok' => 44.0,
                'stok_minimum' => 6.0,
                'harga' => 4000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 1,
                'tgl_register' => '2020-01-13 15:58:54',
            ),
            19 => 
            array (
                'id_bb' => 'BB130120-020',
                'nama' => 'semir hitam',
                'stok' => 0.0,
                'stok_minimum' => 9.0,
                'harga' => 10000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 1,
                'tgl_register' => '2020-01-13 15:59:04',
            ),
            20 => 
            array (
                'id_bb' => 'BB130120-021',
                'nama' => 'semir coklat',
                'stok' => 5.0,
                'stok_minimum' => 6.0,
                'harga' => 10000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 1,
                'tgl_register' => '2020-01-13 15:59:15',
            ),
            21 => 
            array (
                'id_bb' => 'BB130120-022',
                'nama' => 'aprron',
                'stok' => 100.0,
                'stok_minimum' => 7.0,
                'harga' => 20000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 15:59:31',
            ),
            22 => 
            array (
                'id_bb' => 'BB130120-023',
                'nama' => 'masker',
                'stok' => 100.0,
                'stok_minimum' => 7.0,
                'harga' => 2000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 15:59:47',
            ),
            23 => 
            array (
                'id_bb' => 'BB130120-024',
                'nama' => 'sarung tangan karet',
                'stok' => 66.0,
                'stok_minimum' => 9.0,
                'harga' => 14000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 11,
                'tgl_register' => '2020-01-13 16:00:00',
            ),
            24 => 
            array (
                'id_bb' => 'BB130120-025',
                'nama' => 'plastik klip',
                'stok' => 180.0,
                'stok_minimum' => 100.0,
                'harga' => 1200.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 16:00:21',
            ),
            25 => 
            array (
                'id_bb' => 'BB130120-026',
                'nama' => 'silica gel',
                'stok' => 100.0,
                'stok_minimum' => 5.0,
                'harga' => 75000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 16:00:34',
            ),
            26 => 
            array (
                'id_bb' => 'BB130120-027',
                'nama' => 'cat putih',
                'stok' => 100.0,
                'stok_minimum' => 7.0,
                'harga' => 80000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 12,
                'tgl_register' => '2020-01-13 16:00:47',
            ),
            27 => 
            array (
                'id_bb' => 'BB130120-028',
                'nama' => 'cat hitam',
                'stok' => 100.0,
                'stok_minimum' => 4.0,
                'harga' => 80000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 16:01:02',
            ),
            28 => 
            array (
                'id_bb' => 'BB130120-029',
                'nama' => 'cat biru',
                'stok' => 100.0,
                'stok_minimum' => 4.0,
                'harga' => 80000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 16:01:14',
            ),
            29 => 
            array (
                'id_bb' => 'BB130120-030',
                'nama' => 'cat merah',
                'stok' => 100.0,
                'stok_minimum' => 4.0,
                'harga' => 80000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 16:01:28',
            ),
            30 => 
            array (
                'id_bb' => 'BB130120-031',
                'nama' => 'cat kuning',
                'stok' => 100.0,
                'stok_minimum' => 4.0,
                'harga' => 80000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 16:01:38',
            ),
            31 => 
            array (
                'id_bb' => 'BB130120-032',
                'nama' => 'botol spray',
                'stok' => 140.0,
                'stok_minimum' => 100.0,
                'harga' => 4500.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 16:01:53',
            ),
            32 => 
            array (
                'id_bb' => 'BB130120-033',
                'nama' => 'gelas ukur',
                'stok' => 100.0,
                'stok_minimum' => 60.0,
                'harga' => 8000.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 16:02:14',
            ),
            33 => 
            array (
                'id_bb' => 'BB130120-034',
                'nama' => 'botol sabun',
                'stok' => 150.0,
                'stok_minimum' => 100.0,
                'harga' => 3500.0,
                'kadaluarsa' => NULL,
                'id_satuan' => 10,
                'tgl_register' => '2020-01-13 16:02:26',
            ),
        ));
        
        
    }
}