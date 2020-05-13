<?php

namespace App\Repositories;

use App\Models\Listing;

class ListingRepository
{

    public function search(string $locale, array $inputs)
    {
        $query = (new Listing)->newQuery();

        $query
            ->orderBy(array_get($inputs, 'orderBy', 'id'), array_get($inputs, 'direction', 'desc'))
            ->where("title->{$locale}", 'like', '%' . array_get($inputs, 'term') . '%');

        return $query;
    }
}
