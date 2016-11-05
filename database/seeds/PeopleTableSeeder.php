<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeder for the 'people' table
     *
     * @return void
     */
    public function run()
    {
        factory(App\Person::class, 50)->create()->make();
    }
}
