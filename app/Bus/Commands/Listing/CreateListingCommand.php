<?php

namespace App\Bus\Commands\Listing;

use App\Models\Listing;
use App\Validator\ValidatingTrait;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateListingCommand
{
    use Dispatchable, ValidatingTrait;

    public $inputs;

    public $locale;

    public function __construct(string $locale, array $inputs)
    {
        $this->inputs = $inputs;

        $this->locale = $locale;
    }

    public function getData()
    {
        return [
            'title' => array_get($this->inputs, 'title'),
            'type' => array_get($this->inputs, 'type'),
            'location_id' => array_get($this->inputs, 'location_id'),
            'amenities' => array_get($this->inputs, 'amenities'),
            'price' => array_get($this->inputs, 'price'),
            'size' => array_get($this->inputs, 'size'),
            'rooms' => array_get($this->inputs, 'rooms'),
        ];
    }

    public function getRules()
    {
        return [
            'title' => ['required', 'string'],
            'location_id' => ['required'],
            'type' => ['required'],
            'price' => ['required', 'numeric'],
            'size' => ['required', 'numeric'],
            'rooms' => ['required', 'numeric'],
        ];
    }

    public function handle()
    {
        $data = $this->getData();

        $listing = new Listing;
        $listing->setTranslation('title', $this->locale, $data['title']);
        $listing->location_id = $data['location_id'];
        $listing->size = $data['size'];
        $listing->price = $data['price'];
        $listing->rooms = $data['rooms'];
        $listing->baths = $data['baths'];
        $listing->save();
        $attributes = $data['amenities'];
        $attributes[] = $data['type'];
        $listing->attributes()->attach($attributes);

        return $listing->id;
    }
}
