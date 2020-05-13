<?php

namespace App\DataTables;

use App\Models\Transformers\AttributeTransformer;
use App\Repositories\AttributeRepository;

class AttributeDataTable extends BaseDataTable
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
            self::ACTION_EDIT,
            self::ACTION_DELETE,
        ];
    }

    public function getTransformer()
    {
        return (new AttributeTransformer)->setLocale($this->locale);
    }

    public function paginate()
    {
        $repo = new AttributeRepository;

        return $repo
            ->search($this->locale, $this->request->all())
            ->paginate(10);
    }
}
