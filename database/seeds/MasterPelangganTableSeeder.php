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
        ));
        
        
    }
}