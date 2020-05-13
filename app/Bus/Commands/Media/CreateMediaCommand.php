<?php

namespace App\Bus\Commands\Media;

use App\Validator\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateMediaCommand
{
    use Dispatchable, ValidatingTrait;

    public $inputs;

    public $model;

    public function __construct(Model $model, array $inputs)
    {
        $this->inputs = $inputs;
        $this->model = $model;
    }

    public function getData()
    {
        return [
        ];
    }

    public function getRules()
    {
        return [
        ];
    }

    public function handle()
    {
        foreach ($this->inputs as $image) {
            $this->model->addMedia($image)->toMediaCollection('images', 'media');
        }

        $this->model->save();
    }
}
