<?php

namespace App\Models\Transformers;

use App\Models\Listing;
use App\Models\Transformers\BaseTransformer;
use App\Models\Transformers\ImageTransformer;
use App\Repositories\AttributeRepository;
use App\Repositories\LocationRepository;
use League\Fractal\Resource\Item;

class ListingTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'form',
    ];

    protected $defaultIncludes = [
        'images',
    ];

    public function transform(Listing $listing)
    {
        return [
            'id' => $listing->id,
            'title' => $listing->getTranslation('title', $this->locale),
            'location_id' => $listing->location_id,
            'type' => ($type = $listing->type) ? $type->id : null,
            'amenities' => ($amenities = $listing->amenities) ? array_values($amenities->pluck('id')->toArray()) : [],
            'size' => $listing->size,
            'price' => $listing->price,
            'rooms' => $listing->rooms,
            'baths' => $listing->baths,
        ];
    }

    public function includeForm()
    {
        return $this->item(null, function () {
            return [
                'amenities' => $this->amenities(),
                'types' => $this->types(),
                'locations' => $this->locations(),
            ];
        });
    }

    public function includeImages(Listing $listing)
    {
        return $this->collection($listing->media, new ImageTransformer);
    }

    private function amenities()
    {
        $repo = new AttributeRepository;

        return fractal($repo->getAmenity(), function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->getTranslation('title', 'en'),
            ];
        })->toArray();
    }

    private function types()
    {
        $repo = new AttributeRepository;

        return fractal($repo->getType(), function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->getTranslation('title', 'en'),
            ];
        })->toArray();
    }

    private function locations()
    {
        $repo = new LocationRepository;

        return fractal($repo->get(), function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->getTranslation('title', 'en'),
            ];
        })->toArray();
    }
}
