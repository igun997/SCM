<?php

use Illuminate\Database\Seeder;

class MasterSatuanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master__satuan')->delete();
        
        \DB::table('master__satuan')->insert(array (
            0 => 
            array (
                'id_satuan' => 1,
                'nama_satuan' => 'Buah',
            ),
            1 => 
            array (
                'id_satuan' => 2,
                'nama_satuan' => 'Kg',
            ),
            2 => 
            array (
                'id_satuan' => 3,
                'nama_satuan' => 'Botol',
            ),
            3 => 
            array (
                'id_satuan' => 4,
                'nama_satuan' => 'Liter',
            ),
            4 => 
            array (
                'id_satuan' => 5,
                'nama_satuan' => 'Mililter',
            ),
            5 => 
            array (
                'id_satuan' => 6,
                'nama_satuan' => 'Gram',
            ),
            6 => 
            array (
                'id_satuan' => 7,
                'nama_satuan' => 'Bungkus',
            ),
            7 => 
            array (
                'id_satuan' => 8,
                'nama_satuan' => 'Lembar',
            ),
            8 => 
            array (
                'id_satuan' => 9,
                'nama_satuan' => 'Pak',
            ),
            9 => 
            array (
                'id_satuan' => 10,
                'nama_satuan' => 'Pcs',
            ),
            10 => 
            array (
                'id_satuan' => 11,
                'nama_satuan' => 'Pasang',
            ),
            11 => 
            array (
                'id_satuan' => 12,
                'nama_satuan' => 'Cup',
            ),
            12 => 
            array (
                'id_satuan' => 13,
                'nama_satuan' => 'Dirigen',
            ),
        ));
        
        
    }
}