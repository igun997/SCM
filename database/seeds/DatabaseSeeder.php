<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(MasterSatuanTableSeeder::class);
        $this->call(MasterBbTableSeeder::class);
        $this->call(MasterProdukTableSeeder::class);
        $this->call(MasterKomposisiTableSeeder::class);
        $this->call(MasterSuplierTableSeeder::class);
        $this->call(MasterPelangganTableSeeder::class);
        $this->call(MasterTransportasiTableSeeder::class);
        $this->call(PenggunaTableSeeder::class);
        $this->call(PengaturanTableSeeder::class);
        $this->call(PemesananTableSeeder::class);
        $this->call(PemesananDetailTableSeeder::class);
        $this->call(PengadaanBbTableSeeder::class);
        $this->call(PengadaanBbDetailTableSeeder::class);
        $this->call(PengadaanBbReturTableSeeder::class);
        $this->call(PengadaanBbReturDetailTableSeeder::class);
        $this->call(PengadaanProdukTableSeeder::class);
        $this->call(PengadaanProdukDetailTableSeeder::class);
        $this->call(PengadaanProdukReturTableSeeder::class);
        $this->call(PengadaanProdukReturDetailTableSeeder::class);
        $this->call(PengirimanTableSeeder::class);
        $this->call(PengirimanDetailTableSeeder::class);
        $this->call(PenyusutanTableSeeder::class);
        $this->call(PeramalanProduksiTableSeeder::class);
        $this->call(PosTableSeeder::class);
        $this->call(PosBarangTableSeeder::class);
        $this->call(PosPemesananTableSeeder::class);
        $this->call(PosPemesananDetailTableSeeder::class);
        $this->call(ProduksiTableSeeder::class);
        $this->call(ProduksiDetailTableSeeder::class);
    }
}
