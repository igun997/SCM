<?php

use Illuminate\Database\Seeder;

class PemesananTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pemesanan')->delete();
        
        \DB::table('pemesanan')->insert(array (
            0 => 
            array (
                'id_pemesanan' => 'PP071119-001',
                'id_pelanggan' => 'PL250120-003',
                'status_pesanan' => 4,
                'catatan_pemesanan' => 'Stok Set Cuci',
                'status_pembayaran' => 3,
                'bukti' => 'meAVbQUeDu.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2019-11-07 22:45:22',
            ),
            1 => 
            array (
                'id_pemesanan' => 'PP091119-002',
                'id_pelanggan' => 'PL250120-002',
                'status_pesanan' => 4,
                'catatan_pemesanan' => NULL,
                'status_pembayaran' => 3,
                'bukti' => 'wfVD4BEFbI.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2019-11-09 22:48:06',
            ),
            2 => 
            array (
                'id_pemesanan' => 'PP111119-003',
                'id_pelanggan' => 'PL250120-003',
                'status_pesanan' => 4,
                'catatan_pemesanan' => NULL,
                'status_pembayaran' => 3,
                'bukti' => 'FESxSYexKw.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2019-11-11 22:56:21',
            ),
            3 => 
            array (
                'id_pemesanan' => 'PP121119-004',
                'id_pelanggan' => 'PL250120-002',
                'status_pesanan' => 4,
                'catatan_pemesanan' => NULL,
                'status_pembayaran' => 3,
                'bukti' => 'X0mNkgKKZl.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2019-11-12 22:57:54',
            ),
            4 => 
            array (
                'id_pemesanan' => 'PP121119-005',
                'id_pelanggan' => 'PL250120-003',
                'status_pesanan' => 4,
                'catatan_pemesanan' => NULL,
                'status_pembayaran' => 3,
                'bukti' => 'jIw32NqcRx.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2019-11-12 22:58:12',
            ),
            5 => 
            array (
                'id_pemesanan' => 'PP260120-006',
                'id_pelanggan' => 'PL250120-004',
                'status_pesanan' => 4,
                'catatan_pemesanan' => NULL,
                'status_pembayaran' => 3,
                'bukti' => 'UZvpNyYCkd.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2020-01-26 12:53:17',
            ),
            6 => 
            array (
                'id_pemesanan' => 'PP260120-007',
                'id_pelanggan' => 'PL250120-002',
                'status_pesanan' => 4,
                'catatan_pemesanan' => NULL,
                'status_pembayaran' => 3,
                'bukti' => '77tfgXCuir.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2020-01-23 12:53:30',
            ),
            7 => 
            array (
                'id_pemesanan' => 'PP260120-008',
                'id_pelanggan' => 'PL130120-001',
                'status_pesanan' => 4,
                'catatan_pemesanan' => NULL,
                'status_pembayaran' => 3,
                'bukti' => '8SAhTQ1iXW.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2020-01-25 14:02:22',
            ),
            8 => 
            array (
                'id_pemesanan' => 'PP260120-009',
                'id_pelanggan' => 'PL130120-001',
                'status_pesanan' => 4,
                'catatan_pemesanan' => NULL,
                'status_pembayaran' => 3,
                'bukti' => 'lfdYLBzH88.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2020-01-24 15:14:41',
            ),
            9 => 
            array (
                'id_pemesanan' => 'PP260120-010',
                'id_pelanggan' => 'PL130120-001',
                'status_pesanan' => 0,
                'catatan_pemesanan' => NULL,
                'status_pembayaran' => 1,
                'bukti' => 'CLR7qRqPRr.jpeg',
                'pajak' => 0.1,
                'tgl_register' => '2020-01-26 15:32:12',
            ),
        ));
        
        
    }
}