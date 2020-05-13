<?php

namespace Tests\Unit;

use App\Services\RoutingService;
use Tests\TestCase;

class RoutingServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminForm()
    {
        $router = new RoutingService;
        $this->assertIsArray($router->adminForm('lisiting'));
    }
}
