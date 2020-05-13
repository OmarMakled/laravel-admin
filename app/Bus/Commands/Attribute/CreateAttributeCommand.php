<?php

namespace App\Bus\Commands\Attribute;

use App\Models\Attribute;
use App\Validator\ValidatingTrait;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateAttributeCommand
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
            'type' => array_get($this->inputs, 'type'),
        ];
    }

    public function getRules()
    {
        return [
            'title' => ['required', 'string'],
            'type' => ['required'],
        ];
    }

    public function handle()
    {
        $data = $this->getData();

        $attribute = new Attribute;
        $attribute->setTranslation('title', $this->locale, $data['title']);
        $attribute->type = $data['type'];
        $attribute->save();

        return $attribute->id;
    }
}
