<?php

namespace App\DataTables;

use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

abstract class BaseDataTable
{
    public $request;

    public $locale;

    const ACTION_UPLOAD = 'upload';

    const ACTION_DELETE = 'delete';

    const ACTION_EDIT = 'edit';

    public function __construct(string $locale, Request $request)
    {
        $this->request = $request;

        $this->locale = $locale;
    }

    public function make()
    {
        $paginator = $this->paginate();

        return [
            'results' => fractal()
                ->collection($paginator->getCollection())
                ->transformWith($this->getTransformer())
                ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                ->toArray(),
            'actions' => $this->getActions(),
            'fields' => $this->getFields(),
        ];
    }

    abstract public function getFields();

    abstract public function getActions();

    abstract public function getTransformer();

    abstract public function paginate();
}
