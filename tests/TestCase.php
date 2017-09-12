<?php

namespace TheJawker\RouteModuleMacro\Test;

use Mockery;
use Mockery\MockInterface;
use Orchestra\Testbench\TestCase as Orchestra;
use TheJawker\RouteModuleMacro\RouteModuleMacroServiceProvider;

abstract class TestCase extends Orchestra
{
    /** @var MockInterface spy */
    public $spy;
    public function setUp()
    {
        parent::setUp();
        $this->spy = Mockery::spy();
    }
    public function tearDown()
    {
        Mockery::close();
    }
    protected function getPackageProviders($app)
    {
        return [RouteModuleMacroServiceProvider::class];
    }
}