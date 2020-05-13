<?php

namespace App\Repositories;

use App\Models\Attribute;

class AttributeRepository
{
    public function getAmenity()
    {
        return Attribute::where('type', Attribute::AMENITY)->get();
    }

    public function getType()
    {
        return Attribute::where('type', Attribute::TYPE)->get();
    }

    public function search(string $locale, array $inputs)
    {
        $query = (new Attribute)->newQuery();

        return $query
            ->orderBy(array_get($inputs, 'orderBy', 'id'), array_get($inputs, 'direction', 'desc'))
            ->where("title->{$locale}", 'like', '%' . array_get($inputs, 'term') . '%');
    }
}
