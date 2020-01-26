<?php

use Illuminate\Database\Seeder;

class PengadaanBbTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengadaan__bb')->delete();
        
        \DB::table('pengadaan__bb')->insert(array (
            0 => 
            array (
                'id_pengadaan_bb' => 'PBB011119-001',
                'id_suplier' => 'SP130120-001',
                'status_pengadaan' => 7,
                'tgl_diterima' => '2019-11-05',
                'tgl_register' => '2019-11-01 22:33:30',
                'konfirmasi_direktur' => 1,
                'konfirmasi_gudang' => 1,
                'catatan_gudang' => NULL,
                'catatan_pengadaan' => 'Pembelian Sesuai Dengan Safety Stock',
                'catatan_direktur' => NULL,
                'perkiraan_tiba' => '2019-11-04',
                'tgl_perubahan' => '2019-11-05',
                'dibaca_pengadaan' => 0,
                'dibaca_direktur' => 0,
                'dibaca_gudang' => 0,
            ),
            1 => 
            array (
                'id_pengadaan_bb' => 'PBB260120-002',
                'id_suplier' => 'SP130120-001',
                'status_pengadaan' => 7,
                'tgl_diterima' => '2020-01-26',
                'tgl_register' => '2020-01-26 13:01:50',
                'konfirmasi_direktur' => 1,
                'konfirmasi_gudang' => 1,
                'catatan_gudang' => NULL,
                'catatan_pengadaan' => 'Pembelian Di Pasar',
                'catatan_direktur' => NULL,
                'perkiraan_tiba' => '2020-01-26',
                'tgl_perubahan' => '2020-01-26',
                'dibaca_pengadaan' => 0,
                'dibaca_direktur' => 0,
                'dibaca_gudang' => 0,
            ),
            2 => 
            array (
                'id_pengadaan_bb' => 'PBB260120-003',
                'id_suplier' => 'SP130120-001',
                'status_pengadaan' => 7,
                'tgl_diterima' => '2020-01-26',
                'tgl_register' => '2020-01-26 13:20:43',
                'konfirmasi_direktur' => 1,
                'konfirmasi_gudang' => 1,
                'catatan_gudang' => NULL,
                'catatan_pengadaan' => 'Pembelian Langsung',
                'catatan_direktur' => NULL,
                'perkiraan_tiba' => '2020-01-26',
                'tgl_perubahan' => '2020-01-26',
                'dibaca_pengadaan' => 0,
                'dibaca_direktur' => 0,
                'dibaca_gudang' => 0,
            ),
            3 => 
            array (
                'id_pengadaan_bb' => 'PBB260120-004',
                'id_suplier' => 'SP130120-001',
                'status_pengadaan' => 7,
                'tgl_diterima' => '2020-01-26',
                'tgl_register' => '2020-01-26 13:53:27',
                'konfirmasi_direktur' => 1,
                'konfirmasi_gudang' => 1,
                'catatan_gudang' => NULL,
                'catatan_pengadaan' => 'Pembelian Dadakan Atas Produksi',
                'catatan_direktur' => NULL,
                'perkiraan_tiba' => '2020-01-26',
                'tgl_perubahan' => '2020-01-26',
                'dibaca_pengadaan' => 0,
                'dibaca_direktur' => 0,
                'dibaca_gudang' => 0,
            ),
        ));
        
        
    }
}