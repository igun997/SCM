<?php

use Illuminate\Database\Seeder;

class MasterPelangganTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master__pelanggan')->delete();
        
        \DB::table('master__pelanggan')->insert(array (
            0 => 
            array (
                'id_pelanggan' => 'PL130120-001',
                'nama_pelanggan' => 'Sneaklin',
                'alamat' => 'Jl Sekeloa no 65',
                'no_kontak' => '081565456787',
                'email' => 'admin@sneaklin.com',
                'password' => 'admin@sneaklin.com',
                'tgl_register' => '2020-01-13 16:04:15',
            ),
            1 => 
            array (
                'id_pelanggan' => 'PL250120-002',
                'nama_pelanggan' => 'Shoes Lab',
                'alamat' => 'Tubagus Ismail Dalam',
                'no_kontak' => '081265787654',
                'email' => 'interlab@shoeslab.com',
                'password' => 'indra290997',
                'tgl_register' => '2020-01-25 22:13:51',
            ),
            2 => 
            array (
                'id_pelanggan' => 'PL250120-003',
                'nama_pelanggan' => 'Gerai WENOW Banda',
                'alamat' => 'Jl Banda no 97',
                'no_kontak' => '081214657678',
                'email' => 'geraibanda@wenow.id',
                'password' => 'geraibanda@wenow.id',
                'tgl_register' => '2020-01-25 22:15:01',
            ),
            3 => 
            array (
                'id_pelanggan' => 'PL250120-004',
                'nama_pelanggan' => 'Gerai WENOW Cikalong',
                'alamat' => 'Jln Cikalong Dekat RS Cikaong Wetan',
                'no_kontak' => '087678543678',
                'email' => 'geraicikalong@wenow.id',
                'password' => 'geraicikalong@wenow.id',
                'tgl_register' => '2020-01-25 22:15:41',
            ),
        ));
        
        
    }
}