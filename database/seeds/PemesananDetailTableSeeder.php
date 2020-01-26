<?php

use Illuminate\Database\Seeder;

class PemesananDetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pemesanan__detail')->delete();
        
        \DB::table('pemesanan__detail')->insert(array (
            0 => 
            array (
                'id_pd' => 1,
                'id_pemesanan' => 'PP071119-001',
                'id_produk' => 'PR130120-001',
                'jumlah' => 2.0,
                'harga' => 123600.0,
            ),
            1 => 
            array (
                'id_pd' => 2,
                'id_pemesanan' => 'PP071119-001',
                'id_produk' => 'PR130120-002',
                'jumlah' => 3.0,
                'harga' => 97800.0,
            ),
            2 => 
            array (
                'id_pd' => 3,
                'id_pemesanan' => 'PP071119-001',
                'id_produk' => 'PR250120-003',
                'jumlah' => 1.0,
                'harga' => 76800.0,
            ),
            3 => 
            array (
                'id_pd' => 4,
                'id_pemesanan' => 'PP071119-001',
                'id_produk' => 'PR250120-004',
                'jumlah' => 1.0,
                'harga' => 156600.0,
            ),
            4 => 
            array (
                'id_pd' => 5,
                'id_pemesanan' => 'PP071119-001',
                'id_produk' => 'PR250120-005',
                'jumlah' => 1.0,
                'harga' => 73800.0,
            ),
            5 => 
            array (
                'id_pd' => 6,
                'id_pemesanan' => 'PP091119-002',
                'id_produk' => 'PR130120-001',
                'jumlah' => 40.0,
                'harga' => 123600.0,
            ),
            6 => 
            array (
                'id_pd' => 7,
                'id_pemesanan' => 'PP111119-003',
                'id_produk' => 'PR250120-004',
                'jumlah' => 1.0,
                'harga' => 156600.0,
            ),
            7 => 
            array (
                'id_pd' => 8,
                'id_pemesanan' => 'PP111119-003',
                'id_produk' => 'PR250120-003',
                'jumlah' => 1.0,
                'harga' => 76800.0,
            ),
            8 => 
            array (
                'id_pd' => 9,
                'id_pemesanan' => 'PP121119-004',
                'id_produk' => 'PR130120-002',
                'jumlah' => 60.0,
                'harga' => 97800.0,
            ),
            9 => 
            array (
                'id_pd' => 10,
                'id_pemesanan' => 'PP121119-005',
                'id_produk' => 'PR250120-004',
                'jumlah' => 1.0,
                'harga' => 156600.0,
            ),
            10 => 
            array (
                'id_pd' => 11,
                'id_pemesanan' => 'PP260120-006',
                'id_produk' => 'PR130120-001',
                'jumlah' => 1.0,
                'harga' => 123600.0,
            ),
            11 => 
            array (
                'id_pd' => 12,
                'id_pemesanan' => 'PP260120-006',
                'id_produk' => 'PR130120-002',
                'jumlah' => 1.0,
                'harga' => 97800.0,
            ),
            12 => 
            array (
                'id_pd' => 13,
                'id_pemesanan' => 'PP260120-007',
                'id_produk' => 'PR130120-002',
                'jumlah' => 2.0,
                'harga' => 97800.0,
            ),
            13 => 
            array (
                'id_pd' => 14,
                'id_pemesanan' => 'PP260120-007',
                'id_produk' => 'PR250120-004',
                'jumlah' => 1.0,
                'harga' => 156600.0,
            ),
            14 => 
            array (
                'id_pd' => 15,
                'id_pemesanan' => 'PP260120-008',
                'id_produk' => 'PR130120-002',
                'jumlah' => 10.0,
                'harga' => 89650.0,
            ),
            15 => 
            array (
                'id_pd' => 16,
                'id_pemesanan' => 'PP260120-008',
                'id_produk' => 'PR250120-003',
                'jumlah' => 1.0,
                'harga' => 70400.0,
            ),
            16 => 
            array (
                'id_pd' => 17,
                'id_pemesanan' => 'PP260120-008',
                'id_produk' => 'PR250120-004',
                'jumlah' => 1.0,
                'harga' => 156600.0,
            ),
            17 => 
            array (
                'id_pd' => 18,
                'id_pemesanan' => 'PP260120-009',
                'id_produk' => 'PR250120-004',
                'jumlah' => 1.0,
                'harga' => 156600.0,
            ),
            18 => 
            array (
                'id_pd' => 19,
                'id_pemesanan' => 'PP260120-009',
                'id_produk' => 'PR250120-003',
                'jumlah' => 7.0,
                'harga' => 70400.0,
            ),
            19 => 
            array (
                'id_pd' => 20,
                'id_pemesanan' => 'PP260120-010',
                'id_produk' => 'PR250120-004',
                'jumlah' => 27.0,
                'harga' => 156600.0,
            ),
        ));
        
        
    }
}