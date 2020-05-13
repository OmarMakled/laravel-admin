<?php

namespace App\Bus\Commands\Location;

use App\Models\Location;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteLocationCommand
{
    use Dispatchable;

    public $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }
    
    public function handle()
    {
        $this->location->delete();
    }
}
