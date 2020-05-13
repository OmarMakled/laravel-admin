<?php

namespace App\Bus\Commands\Listing;

use App\Models\Listing;
use App\Validator\ValidatingTrait;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateListingCommand
{
    use Dispatchable, ValidatingTrait;

    public $inputs;
    public $listing;
    public $locale;

    public function __construct(string $locale, Listing $listing, array $inputs)
    {
        $this->inputs = $inputs;
        $this->listing = $listing;
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
            'video' => array_get($this->inputs, 'video'),
            'description' => array_get($this->inputs, 'description'),
        ];

    }

    public function getRules()
    {
        return [
            'title' => ['required', 'string'],
            'location_id' => ['required'],
            'type' => ['required'],
            'price' => ['required'],
            'size' => ['required'],
        ];
    }

    public function handle()
    {
        $data = $this->getData();

        $this->listing->setTranslation('title', $this->locale, $data['title']);
        $this->listing->location_id = $data['location_id'];
        $this->listing->size = $data['size'];
        $this->listing->price = $data['price'];
        $this->listing->video = $data['video'];
        $this->listing->description = $data['description'];
        $this->listing->save();
        $attributes = $data['amenities'];
        $attributes[] = $data['type'];
        $this->listing->attributes()->sync($attributes);

        return $this->listing->id;
    }
}
