<?php

namespace App\DataTables;

use App\DataTables\BaseDataTable;
use App\Models\Transformers\ListingTransformer;
use App\Repositories\ListingRepository;

class ListingDataTable extends BaseDataTable
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
            self::ACTION_UPLOAD,
            self::ACTION_DELETE,
            self::ACTION_EDIT,
        ];
    }

    public function getTransformer()
    {
        return (new ListingTransformer)->setLocale($this->locale);
    }

    public function paginate()
    {
        $repo = new ListingRepository;

        return $repo
            ->search($this->locale, $this->request->all())
            ->paginate(10);
    }
}
