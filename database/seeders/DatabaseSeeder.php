<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Client::factory(10)->create();
        \App\Models\User::factory(140)->create();

        //create clients.users
        $flag = 1;
        $endflag = 14;
        for ($i = 1; $i<=10; $i++) {
            for ($j=$flag; $j <= $endflag; $j++) {
                $client =Client::find($i);
                $client->users()->syncWithoutDetaching([$j]);
            }
            $flag = $j+1;
            $endflag += 14;
        }

        \App\Models\Area::factory(250)->create();
        \App\Models\SubArea::factory(500)->create();
        \App\Models\CollectionPoint::factory(1000)->create();
    }
}
