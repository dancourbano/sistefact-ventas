<?php

use Illuminate\Database\Seeder;

class vehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cantidad=30;
        $faker = Faker::create();
        for ($i=0; $i <$cantidad ; $i++) {
            DB::table('vehicle')->insert(array(
               /* 'placa' => $faker->name,
                'sn'  => $faker->randomFloat(null,10,150),
                'shortNumber'  => 1,
                'motorNumber'  => 1,
                'year'  => $faker->numberBetween(300,500),
                'brandCar'  => $faker->numberBetween(300,500),
                'modelClass'  => $faker->numberBetween(300,500),
                'chasisSerie'  => $faker->numberBetween(300,500),
                'comment'  => $faker->numberBetween(300,500),
                'classCar'  => $faker->numberBetween(300,500),
                'internalNumber'  => $faker->numberBetween(300,500),
                'telMov'  => $faker->numberBetween(300,500),
                'telCla'  => $faker->numberBetween(300,500),
                'customerId'  => $faker->randomElement(['0','1']),
                'createdDate' => date('Y-m-d H:m:s')
               */
            ));
        }
    }
}
