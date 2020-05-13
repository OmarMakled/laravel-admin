<?php

use App\Models\Location;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    private $data = [
        [
            'title' => ['en' => 'Cairo', 'ar' => 'القاهره'],
        ],
        [
            'title' => ['en' => 'Alax', 'ar' => 'الاسكندريه'],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Location::truncate();
        foreach ($this->data as $val) {
            $location = new Location;
            $location->setTranslations('title', $val['title']);
            $location->save();
        }
    }
}
