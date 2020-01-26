<?php

use Illuminate\Database\Seeder;

class ProduksiDetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('produksi__detail')->delete();
        
        \DB::table('produksi__detail')->insert(array (
            0 => 
            array (
                'id_pd' => 1,
                'id_produksi' => 'PPR051119-001',
                'id_produk' => 'PR130120-001',
                'jumlah' => 45.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            1 => 
            array (
                'id_pd' => 2,
                'id_produksi' => 'PPR051119-001',
                'id_produk' => 'PR130120-002',
                'jumlah' => 35.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            2 => 
            array (
                'id_pd' => 3,
                'id_produksi' => 'PPR051119-001',
                'id_produk' => 'PR250120-003',
                'jumlah' => 29.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            3 => 
            array (
                'id_pd' => 4,
                'id_produksi' => 'PPR051119-001',
                'id_produk' => 'PR250120-004',
                'jumlah' => 34.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            4 => 
            array (
                'id_pd' => 5,
                'id_produksi' => 'PPR051119-001',
                'id_produk' => 'PR250120-005',
                'jumlah' => 40.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            5 => 
            array (
                'id_pd' => 6,
                'id_produksi' => 'PPR260120-002',
                'id_produk' => 'PR130120-001',
                'jumlah' => 20.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            6 => 
            array (
                'id_pd' => 7,
                'id_produksi' => 'PPR260120-002',
                'id_produk' => 'PR130120-002',
                'jumlah' => 40.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            7 => 
            array (
                'id_pd' => 8,
                'id_produksi' => 'PPR260120-002',
                'id_produk' => 'PR250120-003',
                'jumlah' => 20.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            8 => 
            array (
                'id_pd' => 9,
                'id_produksi' => 'PPR260120-003',
                'id_produk' => 'PR130120-001',
                'jumlah' => 30.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            9 => 
            array (
                'id_pd' => 10,
                'id_produksi' => 'PPR260120-003',
                'id_produk' => 'PR130120-002',
                'jumlah' => 20.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
            10 => 
            array (
                'id_pd' => 11,
                'id_produksi' => 'PPR260120-003',
                'id_produk' => 'PR250120-003',
                'jumlah' => 12.0,
                'bahan_tersedia' => 1,
                'tgl_bahan_tersedia' => NULL,
                'catatan_untuk_pengadaan' => NULL,
            ),
        ));
        
        
    }
}