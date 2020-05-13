<?php

namespace App\Bus\Commands\Attribute;

use App\Models\Attribute;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteAttributeCommand
{
    use Dispatchable;

    public $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    public function handle()
    {
        $this->attribute->delete();
    }
}
