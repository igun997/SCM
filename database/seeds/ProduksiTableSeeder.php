<?php

use Illuminate\Database\Seeder;

class ProduksiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('produksi')->delete();
        
        \DB::table('produksi')->insert(array (
            0 => 
            array (
                'id_produksi' => 'PPR051119-001',
                'jenis' => 'implementasi',
                'alasan_perencanaan' => 'Produksi Alat Cuci',
                'konfirmasi_perencanaan' => 1,
                'catatan_perencanaan' => NULL,
                'konfirmasi_direktur' => 1,
                'konfirmasi_gudang' => 1,
                'catatan_gudang' => NULL,
                'catatan_direktur' => NULL,
                'catatan_produksi' => NULL,
                'status_produksi' => 3,
                'tgl_kon_direktur' => NULL,
                'tgl_kon_gudang' => '2019-11-07',
                'tgl_selesai_produksi' => '2019-11-07',
                'tgl_register' => '2019-11-05 22:41:32',
            ),
            1 => 
            array (
                'id_produksi' => 'PPR260120-002',
                'jenis' => 'implementasi',
                'alasan_perencanaan' => NULL,
                'konfirmasi_perencanaan' => 1,
                'catatan_perencanaan' => NULL,
                'konfirmasi_direktur' => 1,
                'konfirmasi_gudang' => 1,
                'catatan_gudang' => NULL,
                'catatan_direktur' => NULL,
                'catatan_produksi' => NULL,
                'status_produksi' => 3,
                'tgl_kon_direktur' => NULL,
                'tgl_kon_gudang' => '2020-01-26',
                'tgl_selesai_produksi' => '2020-01-26',
                'tgl_register' => '2020-01-26 13:11:18',
            ),
            2 => 
            array (
                'id_produksi' => 'PPR260120-003',
                'jenis' => 'implementasi',
                'alasan_perencanaan' => NULL,
                'konfirmasi_perencanaan' => 1,
                'catatan_perencanaan' => NULL,
                'konfirmasi_direktur' => 1,
                'konfirmasi_gudang' => 1,
                'catatan_gudang' => NULL,
                'catatan_direktur' => NULL,
                'catatan_produksi' => NULL,
                'status_produksi' => 3,
                'tgl_kon_direktur' => NULL,
                'tgl_kon_gudang' => '2020-01-26',
                'tgl_selesai_produksi' => '2020-01-26',
                'tgl_register' => '2020-01-26 13:23:13',
            ),
        ));
        
        
    }
}