<?php

use Illuminate\Database\Seeder;

class PengirimanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengiriman')->delete();
        
        \DB::table('pengiriman')->insert(array (
            0 => 
            array (
                'id_pengiriman' => 'PNP091119-001',
                'id_transportasi' => 'KN130120-001',
                'tgl_pengiriman' => '2019-11-09',
                'tgl_kembali' => '2019-11-09',
                'status_pengiriman' => 3,
                'kontak_pengemudi' => '087657458765',
                'nama_pengemudi' => 'Arif Baskoro',
                'catatan_khusus' => NULL,
                'tgl_register' => '2019-11-09 22:54:19',
            ),
            1 => 
            array (
                'id_pengiriman' => 'PNP260120-002',
                'id_transportasi' => 'KN130120-001',
                'tgl_pengiriman' => '2020-01-26',
                'tgl_kembali' => '2020-01-26',
                'status_pengiriman' => 3,
                'kontak_pengemudi' => '087654789876',
                'nama_pengemudi' => 'Asep',
                'catatan_khusus' => NULL,
                'tgl_register' => '2020-01-26 12:52:22',
            ),
            2 => 
            array (
                'id_pengiriman' => 'PNP260120-003',
                'id_transportasi' => 'KN250120-002',
                'tgl_pengiriman' => '2020-01-26',
                'tgl_kembali' => '2020-01-26',
                'status_pengiriman' => 3,
                'kontak_pengemudi' => '087654789876',
                'nama_pengemudi' => 'Arif Baskoro',
                'catatan_khusus' => NULL,
                'tgl_register' => '2020-01-26 12:55:24',
            ),
            3 => 
            array (
                'id_pengiriman' => 'PNP260120-004',
                'id_transportasi' => 'KN130120-001',
                'tgl_pengiriman' => '2020-01-26',
                'tgl_kembali' => '2020-01-26',
                'status_pengiriman' => 3,
                'kontak_pengemudi' => '087654789876',
                'nama_pengemudi' => 'Arif Baskoro',
                'catatan_khusus' => NULL,
                'tgl_register' => '2020-01-26 14:04:24',
            ),
            4 => 
            array (
                'id_pengiriman' => 'PNP260120-005',
                'id_transportasi' => 'KN130120-001',
                'tgl_pengiriman' => '2020-01-26',
                'tgl_kembali' => '2020-01-26',
                'status_pengiriman' => 3,
                'kontak_pengemudi' => '087654789876',
                'nama_pengemudi' => 'Arif Baskoro',
                'catatan_khusus' => NULL,
                'tgl_register' => '2020-01-26 15:16:22',
            ),
        ));
        
        
    }
}