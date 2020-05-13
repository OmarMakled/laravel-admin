<?php

namespace App\Bus\Commands\Listing;

use App\Models\Listing;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteListingCommand
{
    use Dispatchable;

    public $listing;

    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    public function handle()
    {
        $this->listing->delete();
    }
}
