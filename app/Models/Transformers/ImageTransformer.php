<?php

namespace App\Models\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\MediaLibrary\Models\Media;

class ImageTransformer extends TransformerAbstract
{
    public function transform(Media $image)
    {
        return [
            'id' => $image->id,
            'thumb' => $image->getUrl('thumb'),
            'large' => $image->getUrl(),
        ];
    }
}
