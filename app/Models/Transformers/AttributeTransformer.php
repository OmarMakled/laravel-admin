<?php

namespace App\Models\Transformers;

use App\Models\Attribute;
use App\Models\Transformers\BaseTransformer;

class AttributeTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'form',
    ];

    public function transform(Attribute $attribute)
    {
        return [
            'id' => $attribute->id,
            'title' => $attribute->getTranslation('title', $this->locale),
            'type' => $attribute->type,
            'amenities' => $attribute->amenities,
        ];
    }

    public function includeForm()
    {
        return $this->item(null, function () {
            return [
                'types' => [
                    ['id' => Attribute::TYPE, 'title' => 'Type'],
                    ['id' => Attribute::AMENITY, 'title' => 'Amenity'],
                ],
            ];
        });
    }
}
