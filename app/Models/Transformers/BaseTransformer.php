<?php
namespace App\Models\Transformers;

use League\Fractal\TransformerAbstract;

abstract class BaseTransformer extends TransformerAbstract
{
    public $locale;

    public function setLocale(string $locale)
    {
        $this->locale = $locale;

        return $this;
    }
}
