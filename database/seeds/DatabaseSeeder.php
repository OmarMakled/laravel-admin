<?php

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
        $this->call([
            AttributeSeeder::class,
            LocationSeeder::class,
            ListingSeeder::class,
            UserSeeder::class,
        ]);
    }
}
