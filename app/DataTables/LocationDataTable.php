<?php

namespace App\DataTables;

use App\DataTables\BaseDataTable;
use App\Models\Transformers\LocationTransformer;
use App\Repositories\LocationRepository;

class LocationDataTable extends BaseDataTable
{
    public function getFields()
    {
        return [
            ['id' => 'id', 'title' => trans('text.id'), 'sortable' => true],
            ['id' => 'title', 'title' => trans('text.title'), 'sortable' => true],
        ];
    }

    public function getActions()
    {
        return [
            self::ACTION_DELETE,
            self::ACTION_EDIT,
        ];
    }

    public function getTransformer()
    {
        return (new LocationTransformer)->setLocale($this->locale);
    }

    public function paginate()
    {
        $repo = new LocationRepository;

        return $repo
            ->search($this->locale, $this->request->all())
            ->paginate(10);
    }
}
