<?php

namespace TheJawker\RouteModuleMacro;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RouteModuleMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (!Router::hasMacro('module')) {
            $this->registerMacro(app(Router::class));
        }
    }

    private function registerMacro(Router $router)
    {
        $router->macro('module', function ($module, $only = [], $options = []) use ($router) {
            $onlyOptions = count($only) ? ['only' => $only] : [];

            $controllerNameArray = collect(explode('.', $module))->map(function ($name) {
                return studly_case($name);
            });

            $lastName = $controllerNameArray->pop();

            $controllerName = $controllerNameArray->map(function ($name) {
                return str_singular($name);
            })->push($lastName)->push('Controller')->implode('');

            $router->resource($module, $controllerName, array_merge($onlyOptions, $options));
        });
    }
}