<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class CustomerTableSeeder extends Seeder
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
            DB::table('customer')->insert(array(
                'name' => $faker->firstName,
                'lastname'  => $faker->lastName(),
                'identification'  => $faker->unique()->ean8,
                'address'  => $faker->address,
                'city'  => $faker->city,
                'email'  => $faker->freeEmail,
                'phone1' => $faker->e164PhoneNumber,
                'phone2' => $faker->e164PhoneNumber,
                'createdDate' => date('Y-m-d H:m:s'),
                'birthday' => date('Y-m-d H:m:s'),
                'type' => $faker->randomElement(['0','1'])
            ));
        }
    }
}
