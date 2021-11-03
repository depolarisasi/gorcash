<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use DB;
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 50; $i++){
            // insert data ke table pegawai menggunakan Faker $table->increments('produk_id');
            DB::table('produk')->insert([
              'produk_sku' => "GC".$faker->randomLetter().$faker->numberBetween(0,9999),
              'produk_nama' => $faker->city,
              'produk_idvendor' => 1,
              'produk_idsize' => $faker->numberBetween(1,9),
              'produk_idband' => $faker->numberBetween(1,3),
              'produk_hargajual' => 365000,
              'produk_hargabeli' => 265000,
              'produk_stok' => $faker->numberBetween(1,5),
              'produk_tanggalbeli' => "2021-11-01"
             ]);

  }
    }
}
