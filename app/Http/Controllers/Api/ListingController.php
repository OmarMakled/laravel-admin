<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Transformers\ListingTransformer;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function getList(Request $request)
    {
        $listings = Listing::with(['media'])->get();

        $listings = fractal()
            ->collection($listings)
            ->transformWith(new ListingTransformer())
            ->toArray();

        return response()->json([
            'listings' => $listings['data'],
        ]);
    }
}
