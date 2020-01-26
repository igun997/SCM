<?php

use Illuminate\Database\Seeder;

class PengirimanDetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengiriman__detail')->delete();
        
        \DB::table('pengiriman__detail')->insert(array (
            0 => 
            array (
                'id_pd' => 1,
                'id_pengiriman' => 'PNP091119-001',
                'id_pemesanan' => 'PP071119-001',
                'alamat_tujuan' => 'Jl Banda no 97',
                'catatan_khusus' => 'Stok Set Cuci',
            ),
            1 => 
            array (
                'id_pd' => 2,
                'id_pengiriman' => 'PNP091119-001',
                'id_pemesanan' => 'PP091119-002',
                'alamat_tujuan' => 'Tubagus Ismail Dalam',
                'catatan_khusus' => NULL,
            ),
            2 => 
            array (
                'id_pd' => 3,
                'id_pengiriman' => 'PNP260120-002',
                'id_pemesanan' => 'PP111119-003',
                'alamat_tujuan' => 'Jl Banda no 97',
                'catatan_khusus' => NULL,
            ),
            3 => 
            array (
                'id_pd' => 4,
                'id_pengiriman' => 'PNP260120-002',
                'id_pemesanan' => 'PP121119-004',
                'alamat_tujuan' => 'Tubagus Ismail Dalam',
                'catatan_khusus' => NULL,
            ),
            4 => 
            array (
                'id_pd' => 5,
                'id_pengiriman' => 'PNP260120-002',
                'id_pemesanan' => 'PP121119-005',
                'alamat_tujuan' => 'Jl Banda no 97',
                'catatan_khusus' => NULL,
            ),
            5 => 
            array (
                'id_pd' => 6,
                'id_pengiriman' => 'PNP260120-003',
                'id_pemesanan' => 'PP260120-006',
                'alamat_tujuan' => 'Jln Cikalong Dekat RS Cikaong Wetan',
                'catatan_khusus' => NULL,
            ),
            6 => 
            array (
                'id_pd' => 7,
                'id_pengiriman' => 'PNP260120-003',
                'id_pemesanan' => 'PP260120-007',
                'alamat_tujuan' => 'Tubagus Ismail Dalam',
                'catatan_khusus' => NULL,
            ),
            7 => 
            array (
                'id_pd' => 8,
                'id_pengiriman' => 'PNP260120-004',
                'id_pemesanan' => 'PP260120-008',
                'alamat_tujuan' => 'Jl Sekeloa no 65',
                'catatan_khusus' => NULL,
            ),
            8 => 
            array (
                'id_pd' => 9,
                'id_pengiriman' => 'PNP260120-005',
                'id_pemesanan' => 'PP260120-009',
                'alamat_tujuan' => 'Jl Sekeloa no 65',
                'catatan_khusus' => NULL,
            ),
        ));
        
        
    }
}