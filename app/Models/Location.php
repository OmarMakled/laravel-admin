<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{
    use HasTranslations;

    public $translatable = ['title'];

    public $timestamps = false;

    protected $guarded = [];
}
