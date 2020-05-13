<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use HasTranslations;

    public $translatable = ['title'];

    public $timestamps = false;

    protected $guarded = [];

    public function scopeSearch($query, string $locale, array $inputs)
    {
        if (isset($inputs['orderBy']) && isset($inputs['direction'])) {
            $query->orderBy($inputs['orderBy'], $inputs['direction']);
        }

        if (isset($inputs['term'])) {
            $query->where("title->{$locale}", 'like', '%' . $inputs['term'] . '%');
        }

        return $query;
    }
}
