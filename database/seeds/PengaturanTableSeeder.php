<?php

use Illuminate\Database\Seeder;

class PengaturanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengaturan')->delete();
        
        \DB::table('pengaturan')->insert(array (
            0 => 
            array (
                'id_pengaturan' => 1,
                'meta_key' => 'ppn',
                'meta_value' => '10',
                'valid' => '2019-11-04 15:38:28',
            ),
            1 => 
            array (
                'id_pengaturan' => 3,
                'meta_key' => 'pph',
                'meta_value' => '5',
                'valid' => '2019-11-04 18:26:28',
            ),
        ));
        
        
    }
}