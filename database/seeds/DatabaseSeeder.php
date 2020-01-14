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
        $this->call(PenggunaTableSeeder::class);
        $this->call(PengaturanTableSeeder::class);
        $this->call(MasterPelangganTableSeeder::class);
        $this->call(MasterProdukTableSeeder::class);
        $this->call(MasterBbTableSeeder::class);
        $this->call(MasterSuplierTableSeeder::class);
        $this->call(MasterSatuanTableSeeder::class);
        $this->call(MasterTransportasiTableSeeder::class);
    }
}
