<?php

use Illuminate\Database\Seeder;

class MasterTransportasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master__transportasi')->delete();
        
        \DB::table('master__transportasi')->insert(array (
            0 => 
            array (
                'id_transportasi' => 'KN130120-001',
                'jenis_transportasi' => 'mobil',
                'no_polisi' => 'D 6547 BH',
                'status_kendaraan' => 0,
                'tgl_register' => '2020-01-13 16:02:43',
            ),
            1 => 
            array (
                'id_transportasi' => 'KN250120-002',
                'jenis_transportasi' => 'mobil',
                'no_polisi' => 'Z 6754 BH',
                'status_kendaraan' => 0,
                'tgl_register' => '2020-01-25 22:31:36',
            ),
        ));
        
        
    }
}