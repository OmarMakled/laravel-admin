<?php

namespace App\Models\Transformers;

use App\Models\Location;
use App\Models\Transformers\BaseTransformer;

class LocationTransformer extends BaseTransformer
{
    public function transform(Location $location)
    {
        return [
            'id' => $location->id,
            'title' => $location->getTranslation('title', $this->locale),
        ];
    }
}
