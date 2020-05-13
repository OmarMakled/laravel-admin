<?php

namespace App\Bus\Commands\Attribute;

use App\Models\Attribute;
use App\Validator\ValidatingTrait;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateAttributeCommand
{
    use Dispatchable, ValidatingTrait;

    public $inputs;

    public $attribute;

    public $locale;

    public function __construct(string $locale, Attribute $attribute, array $inputs)
    {
        $this->inputs = $inputs;
        $this->attribute = $attribute;
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
        ];
    }

    public function handle()
    {
        $data = $this->getData();

        $this->attribute->setTranslation('title', $this->locale, $data['title']);
        $this->attribute->type = $data['type'];
        $this->attribute->save();

        return $this->attribute->id;
    }
}
