<?php

namespace App\Bus\Commands\Location;

use App\Models\Location;
use App\Validator\ValidatingTrait;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateLocationCommand
{
    use Dispatchable, ValidatingTrait;

    public $inputs;
    public $locale;

    public function __construct(string $locale, array $inputs)
    {
        $this->inputs = $inputs;
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

        $location = new Location;
        $location->setTranslation('title', $this->locale, $data['title']);
        $location->save();

        return $location->id;
    }
}
