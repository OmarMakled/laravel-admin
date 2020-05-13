<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use DispatchesJobs;

    public $locale;

    public function __construct(Request $request)
    {
        $this->locale = $request->locale ?? $request->headers->get('Accept-Language');
    }
}
