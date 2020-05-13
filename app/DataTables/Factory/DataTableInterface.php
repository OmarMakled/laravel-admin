<?php

namespace App\DataTables\Factory;

interface DataTableInterface
{
    public function make(string $locale, string $model);
}
