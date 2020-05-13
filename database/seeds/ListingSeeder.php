<?php

use App\Models\Listing;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    private $data = [
        [
            'title' => ['en' => 'villa for sale', 'ar' => 'فيلا للبيع'],
            'attributes' => [1, 10],
            'size' => 120,
            'location_id' => 1,
            'price' => 11200.00,
        ],
        [
            'title' => ['en' => 'studio for sale', 'ar' => 'استوديو للبيع'],
            'attributes' => [1, 10],
            'size' => 220,
            'location_id' => 1,
            'price' => 112200.00,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Listing::truncate();
        foreach ($this->data as $val) {
            $listing = new Listing;
            $listing->setTranslations('title', $val['title']);
            $listing->location_id = $val['location_id'];
            $listing->price = $val['price'];
            $listing->size = $val['size'];
            $listing->save();

            $listing->attributes()->attach($val['attributes']);
        }
    }
}
