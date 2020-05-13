<?php

namespace App\DataTables\Factory;

use App\DataTables\Factory\DataTableInterface;
use Illuminate\Http\Request;

class DataTable implements DataTableInterface
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function make(string $locale, string $model)
    {
        $dt = '\\App\\DataTables\\' . ucwords($model) . 'DataTable';

        return (new $dt($locale, $this->request))->make();
    }
}
