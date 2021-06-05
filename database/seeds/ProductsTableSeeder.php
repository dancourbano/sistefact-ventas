<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $cantidad=30;
        $faker = Faker::create();
        for ($i=0; $i <$cantidad ; $i++) {
            DB::table('item')->insert(array(
                'descripcion' => $faker->name,
                'basePrice'  => $faker->randomFloat(null,10,150),
                'type'  => 1,
                'itemNumber'  => $faker->numberBetween(300,500),
                'status'  => $faker->randomElement(['0','1']),
                'itemNumCurrent'  => $faker->numberBetween(5,200),
                'createdDate' => date('Y-m-d H:m:s')
            ));
        }
    }
}
