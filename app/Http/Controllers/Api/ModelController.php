<?php

namespace App\Http\Controllers\Api;

use App\Bus\Commands\Media\CreateMediaCommand;
use App\DataTables\Factory\DataTableInterface;
use App\Http\Controllers\Controller;
use App\Validator\ValidationException;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function create(string $model, Request $request)
    {
        try {
            $str = ucwords($model);
            $command = "\\App\\Bus\\Commands\\{$str}\\Create{$str}Command";
            return response()->json([
                'id' => $command::dispatchNow($this->locale, $request->all()),
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->getMessageBag()], 422);
        }
    }

    public function update(string $model, string $id, Request $request)
    {
        try {
            $str = ucwords($model);
            $entity = '\\App\\Models\\' . $model;
            $entity = $entity::findOrFail($id);
            $command = "\\App\\Bus\\Commands\\{$str}\\Update{$str}Command";
            return response()->json([
                'id' => $command::dispatchNow($this->locale, $entity, $request->all()),
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->getMessageBag()], 422);
        }
    }

    public function delete(string $model, string $id)
    {
        try {
            $str = ucwords($model);
            $entity = '\\App\\Models\\' . $model;
            $entity = $entity::findOrFail($id);
            $command = "\\App\\Bus\\Commands\\{$str}\\Delete{$str}Command";
            $command::dispatchNow($entity);
            return response()->json([], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->getMessageBag()], 422);
        }
    }

    public function upload(string $model, string $id, Request $request)
    {
        $entity = '\\App\\Models\\' . ucwords($model);
        $entity = $entity::findOrFail($id);
        $command = CreateMediaCommand::dispatchNow($entity, $request->file('files', []));
        return response()->json([], 201);
    }

    public function search(string $model, DataTableInterface $dt)
    {
        return $dt->make($this->locale, $model);
    }

    public function get(string $model, $id = null)
    {
        $entity = '\\App\\Models\\' . ucwords($model);
        $transformer = '\\App\\Models\\Transformers\\' . ucwords($model) . 'Transformer';
        $entity = new $entity;

        if ($id) {
            $entity = $entity::findOrFail($id);
        }

        return fractal()
            ->item($entity, (new $transformer())->setLocale($this->locale), $model)
            ->includeForm()
            ->toArray();
    }
}
