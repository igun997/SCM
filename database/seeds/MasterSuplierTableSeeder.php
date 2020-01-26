<?php

use Illuminate\Database\Seeder;

class MasterSuplierTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master__suplier')->delete();
        
        \DB::table('master__suplier')->insert(array (
            0 => 
            array (
                'id_suplier' => 'SP130120-001',
                'nama_suplier' => 'Pasar Cikalong',
                'no_kontak' => '000000000000',
                'email' => 'cikalong@wetan.com',
                'alamat' => 'Pasar Cikalong',
                'ket' => 'Pasar',
                'tgl_register' => '2020-01-13 16:15:23',
            ),
            1 => 
            array (
                'id_suplier' => 'SP130120-002',
                'nama_suplier' => 'Mang Idin',
                'no_kontak' => '08765678754000',
                'email' => 'idinhermasyah@gmail.com',
                'alamat' => 'Jalan Cipatat',
                'ket' => 'Suplier Bahan Baku',
                'tgl_register' => '2020-01-13 16:16:03',
            ),
            2 => 
            array (
                'id_suplier' => 'SP250120-003',
                'nama_suplier' => 'Jaya Plaza  Lt 1',
                'no_kontak' => '0226785467',
                'email' => 'iikhermansyah@gmail.com',
                'alamat' => 'Jalan Kosambi , Mal Jaya Plaza',
                'ket' => 'Suplier Peralatan Cuci',
                'tgl_register' => '2020-01-25 22:17:25',
            ),
            3 => 
            array (
                'id_suplier' => 'SP250120-004',
                'nama_suplier' => 'Toko Parfume Cijerah',
                'no_kontak' => '081167567898',
                'email' => '081167567898@gmail.com',
                'alamat' => 'Pertigaan Cijerah dekat Cimindi',
                'ket' => 'Suplier Parfum',
                'tgl_register' => '2020-01-25 22:19:23',
            ),
        ));
        
        
    }
}