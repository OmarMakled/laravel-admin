<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasTranslations;

    const TYPE = 1;

    const AMENITY = 2;

    public $translatable = ['title'];

    public $timestamps = false;
}
