<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    public function get()
    {
        return Location::get();
    }

    public function search(string $locale, array $inputs)
    {
        $query = (new Location)->newQuery();

        return $query
            ->orderBy(array_get($inputs, 'orderBy', 'id'), array_get($inputs, 'direction', 'desc'))
            ->where("title->{$locale}", 'like', '%' . array_get($inputs, 'term') . '%');
    }
}
