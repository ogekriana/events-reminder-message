<?php

use Illuminate\Database\Seeder;
use SimpleProject\Event;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach(range(1,10) as $index){
        	Event::create([
        		'user_id' => $faker->numberBetween($min = 1, $max = 5),
        		'date' => $faker->date($format = 'Y-m-d', $min = 'now'),
        		'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        		'description' => $faker->realText($maxNbChars = 200, $indexSize = 2)
        	]);
        }
    }
}
