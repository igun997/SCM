<?php

use Illuminate\Database\Seeder;

class PeramalanProduksiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('peramalan__produksi')->delete();
        
        \DB::table('peramalan__produksi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_produk' => 'PR130120-001',
                'prakira' => 100.0,
                'tgl_dibuat' => '2019-12-01',
                'jenis' => 'manual',
            ),
            1 => 
            array (
                'id' => 2,
                'id_produk' => 'PR130120-002',
                'prakira' => 100.0,
                'tgl_dibuat' => '2019-12-01',
                'jenis' => 'manual',
            ),
            2 => 
            array (
                'id' => 3,
                'id_produk' => 'PR250120-003',
                'prakira' => 100.0,
                'tgl_dibuat' => '2019-12-01',
                'jenis' => 'manual',
            ),
            3 => 
            array (
                'id' => 4,
                'id_produk' => 'PR250120-004',
                'prakira' => 100.0,
                'tgl_dibuat' => '2019-12-01',
                'jenis' => 'manual',
            ),
            4 => 
            array (
                'id' => 5,
                'id_produk' => 'PR250120-005',
                'prakira' => 100.0,
                'tgl_dibuat' => '2019-12-01',
                'jenis' => 'manual',
            ),
        ));
        
        
    }
}