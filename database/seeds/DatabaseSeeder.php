<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ProductsTableSeeder::class);
        //$this->call(ServiceTableSeeder::class);
        //$this->call(CustomerTableSeeder::class);
        $this->call(MovementTableSeeder::class);
    }
}
