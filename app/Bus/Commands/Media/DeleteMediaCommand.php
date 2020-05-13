<?php

namespace App\Bus\Commands\Media;

use App\Models\Media;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteMediaCommand
{
    use Dispatchable;

    public $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    public function handle()
    {
        $this->media->delete();
    }
}
