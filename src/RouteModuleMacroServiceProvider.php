<?php

namespace TheJawker\RouteModuleMacro;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RouteModuleMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (!Router::hasMacro('module')) {
            $this->registerMacro();
        }
    }

    private function registerMacro()
    {
        Router::macro('module', function ($module, $only = [], $options = []) {
            $onlyOptions = count($only) ? ['only' => $only] : [];

            $controllerNameArray = collect(explode('.', $module))->map(function ($name) {
                return studly_case($name);
            });

            $lastName = $controllerNameArray->pop();

            $controllerName = $controllerNameArray->map(function ($name) {
                return str_singular($name);
            })->push($lastName)->push('Controller')->implode('');

            Router::resource($module, $controllerName, array_merge($onlyOptions, $options));
        });
    }
}