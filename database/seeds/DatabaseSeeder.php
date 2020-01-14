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
    }
}
