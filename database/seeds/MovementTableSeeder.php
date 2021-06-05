<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class MovementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $cantidad=100;
        $faker = Faker::create();
        for ($i=0; $i <$cantidad ; $i++) {
            $date = $faker -> dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = date_default_timezone_get());
            DB::table('movement')->insert(array(
                'quantity'  => $faker->randomFloat(null,5,1500),
                'type'  => $faker->randomElement(['1','2','3']),
                'description' => $faker -> realText($maxNbChars = 220, $indexSize = 2),
                'concept' => $faker -> realText($maxNbChars = 220, $indexSize = 2),
                'sender' => $faker->name,
                'comprobanteNumber' => $faker -> numberBetween($min = 1, $max = 100),
                'modifiedDate' => $date,
                'createdDate' => $date
            ));
        }
    }
}
