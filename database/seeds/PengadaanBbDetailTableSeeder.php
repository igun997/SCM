<?php

use Illuminate\Database\Seeder;

class PengadaanBbDetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengadaan__bb_detail')->delete();
        
        \DB::table('pengadaan__bb_detail')->insert(array (
            0 => 
            array (
                'id_pbb_detail' => 1,
                'id_bb' => 'BB130120-025',
                'jumlah' => 80.0,
                'harga' => 1200.0,
                'id_pengadaan_bb' => 'PBB011119-001',
            ),
            1 => 
            array (
                'id_pbb_detail' => 2,
                'id_bb' => 'BB130120-032',
                'jumlah' => 40.0,
                'harga' => 4500.0,
                'id_pengadaan_bb' => 'PBB011119-001',
            ),
            2 => 
            array (
                'id_pbb_detail' => 3,
                'id_bb' => 'BB130120-034',
                'jumlah' => 50.0,
                'harga' => 3500.0,
                'id_pengadaan_bb' => 'PBB011119-001',
            ),
            3 => 
            array (
                'id_pbb_detail' => 4,
                'id_bb' => 'BB130120-002',
                'jumlah' => 100.0,
                'harga' => 6500.0,
                'id_pengadaan_bb' => 'PBB260120-002',
            ),
            4 => 
            array (
                'id_pbb_detail' => 5,
                'id_bb' => 'BB130120-006',
                'jumlah' => 100.0,
                'harga' => 50000.0,
                'id_pengadaan_bb' => 'PBB260120-002',
            ),
            5 => 
            array (
                'id_pbb_detail' => 6,
                'id_bb' => 'BB130120-010',
                'jumlah' => 100.0,
                'harga' => 15000.0,
                'id_pengadaan_bb' => 'PBB260120-002',
            ),
            6 => 
            array (
                'id_pbb_detail' => 7,
                'id_bb' => 'BB130120-011',
                'jumlah' => 100.0,
                'harga' => 11000.0,
                'id_pengadaan_bb' => 'PBB260120-002',
            ),
            7 => 
            array (
                'id_pbb_detail' => 8,
                'id_bb' => 'BB130120-017',
                'jumlah' => 100.0,
                'harga' => 9000.0,
                'id_pengadaan_bb' => 'PBB260120-002',
            ),
            8 => 
            array (
                'id_pbb_detail' => 9,
                'id_bb' => 'BB130120-020',
                'jumlah' => 100.0,
                'harga' => 10000.0,
                'id_pengadaan_bb' => 'PBB260120-002',
            ),
            9 => 
            array (
                'id_pbb_detail' => 10,
                'id_bb' => 'BB130120-002',
                'jumlah' => 100.0,
                'harga' => 6500.0,
                'id_pengadaan_bb' => 'PBB260120-003',
            ),
            10 => 
            array (
                'id_pbb_detail' => 11,
                'id_bb' => 'BB130120-010',
                'jumlah' => 100.0,
                'harga' => 15000.0,
                'id_pengadaan_bb' => 'PBB260120-003',
            ),
            11 => 
            array (
                'id_pbb_detail' => 12,
                'id_bb' => 'BB130120-019',
                'jumlah' => 100.0,
                'harga' => 4000.0,
                'id_pengadaan_bb' => 'PBB260120-003',
            ),
            12 => 
            array (
                'id_pbb_detail' => 13,
                'id_bb' => 'BB130120-020',
                'jumlah' => 6.0,
                'harga' => 10000.0,
                'id_pengadaan_bb' => 'PBB260120-004',
            ),
        ));
        
        
    }
}