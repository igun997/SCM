<?php

use Illuminate\Database\Seeder;

class PenggunaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengguna')->delete();
        
        \DB::table('pengguna')->insert(array (
            0 => 
            array (
                'id_pengguna' => 'PG090919-002',
                'nama_pengguna' => 'Pengadaan',
                'no_kontak' => '081214267696',
                'alamat' => 'Bandung',
                'level' => 'pengadaan',
                'status' => 1,
                'email' => 'pengadaan@wenow.id',
                'password' => 'pengadaan@wenow.id',
                'tgl_register' => '2019-09-09 17:26:29',
            ),
            1 => 
            array (
                'id_pengguna' => 'PG240919-003',
                'nama_pengguna' => 'Gudang',
                'no_kontak' => '081214267697',
                'alamat' => 'gudang@wenow.id',
                'level' => 'gudang',
                'status' => 1,
                'email' => 'gudang@wenow.id',
                'password' => 'gudang@wenow.id',
                'tgl_register' => '2019-09-24 19:32:12',
            ),
            2 => 
            array (
                'id_pengguna' => 'PG271019-001',
                'nama_pengguna' => 'Direktur',
                'no_kontak' => '081214257575',
                'alamat' => 'Direktur',
                'level' => 'direktur',
                'status' => 1,
                'email' => 'direktur@wenow.id',
                'password' => 'direktur@wenow.id',
                'tgl_register' => '2019-10-27 16:51:09',
            ),
        ));
        
        
    }
}