<?php

namespace App\Models;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;

class Listing extends Model implements HasMedia
{
    use HasMediaTrait, HasTranslations;

    protected $guarded = [];

    public $translatable = ['title'];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(291)
            ->height(194);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function getTypeAttribute()
    {
        return $this->attributes()
            ->where('type', Attribute::TYPE)
            ->first();
    }

    public function getAmenitiesAttribute()
    {
        return $this->attributes()
            ->where('type', Attribute::AMENITY)
            ->get();
    }
}
