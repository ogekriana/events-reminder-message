<?php

use Illuminate\Database\Seeder;
use SimpleProject\EventReminder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class EventRemindersTableSeeder extends Seeder
{
    public function run()
    {
    	$faker = Faker\Factory::create();
        foreach(range(1,10) as $index){
        	EventReminder::create([
        		'event_id' => $faker->numberBetween($min = 1, $max = 5),
        		'remind_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
        		'message' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        		'remind_to' => $faker->email
        	]);
        }
    }
}
