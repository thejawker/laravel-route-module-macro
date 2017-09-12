<?php

namespace TheJawker\RouteModuleMacro\Test;

use Illuminate\Support\Facades\Route;

class PackageWorksTest extends TestCase
{
    /** @test */
    public function routes_can_be_registered_via_the_macro()
    {
        Route::module('posts');

        $this->assertUriExist('posts');
    }

    private function assertUriExist($uri)
    {
        $this->assertNotNull( $this->getRoutes()->where('uri', $uri)->count(), 'The URI does not exist.');
    }

    private function getRoutes()
    {
        return collect(Route::getRoutes());
    }
}