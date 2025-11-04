<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// database/seeders/AnalyticsSeeder.php
class AnalyticsSeeder extends Seeder
{
    public function run(): void
    {
        $movies = \App\Models\Movie::take(6)->get();
        if ($movies->isEmpty()) {
            $movies = \App\Models\Movie::factory()->count(6)->create();
        }

        $pages = ['home','movies','cinemas','promotions','candies','corporate'];

        for ($d = 0; $d < 30; $d++) {
            $date = now()->subDays($d);

            // Tickets
            foreach ($movies as $m) {
                \App\Models\Ticket::create([
                    'movie_id' => $m->id,
                    'cinema_id'=> null,
                    'user_id'  => null,
                    'show_date'=> $date->toDateString(),
                    'qty'      => rand(5, 30),
                    'price_total' => rand(5,30) * 15.90,
                ]);
            }

            // Snack orders
            for ($i=0;$i<rand(2,6);$i++){
                \App\Models\SnackOrder::create([
                    'user_id'=> null,
                    'total'  => rand(10,60),
                    'created_at'=>$date->copy()->setTime(rand(10,22), rand(0,59))
                ]);
            }

            // Visits
            for ($i=0;$i<rand(40,120);$i++){
                \App\Models\Visit::create([
                    'page' => $pages[array_rand($pages)],
                    'visited_at' => $date->copy()->setTime(rand(8,23), rand(0,59)),
                ]);
            }
        }
    }
}

