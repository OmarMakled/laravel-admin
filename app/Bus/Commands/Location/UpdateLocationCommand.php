<?php

namespace App\Bus\Commands\Location;

use App\Models\Location;
use App\Validator\ValidatingTrait;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateLocationCommand
{
    use Dispatchable, ValidatingTrait;

    public $inputs;

    public $location;

    public $locale;

    public function __construct(string $locale, Location $location, array $inputs)
    {
        $this->inputs = $inputs;
        $this->location = $location;
        $this->locale = $locale;
    }

    public function getData()
    {
        return [
            'title' => array_get($this->inputs, 'title'),
        ];
    }

    public function getRules()
    {
        return [
            'title' => ['required', 'string'],
        ];
    }

    public function handle()
    {
        $data = $this->getData();
        $this->location->setTranslation('title', $this->locale, $data['title']);
        $this->location->save();

        return $this->location->id;
    }
}
