<?php
/**
 * Created by PhpStorm.
 * User: idn-lee
 * Date: 18-3-19
 * Time: 上午9:06
 */

namespace DDVue\AdminPanel\app\Console\Commands;


use Illuminate\Console\GeneratorCommand;

class CrudControllerCommand extends GeneratorCommand
{
    protected $name        = 'crud:controller';
    protected $signature   = 'crud:controller {name}';
    protected $description = '生成一个 CRUD controller';
    protected $type        = 'Controller';

    protected function getPath($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'CrudController.php';
    }

    protected function getStub()
    {
        return __DIR__ . '/../stubs/crud-controller.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers\Admin';
    }

    protected function replaceNameStrings(&$stub, $namespace)
    {
        $name = explode('\\', $namespace);
        $name = array_pop($name);
        $route    = 'Admin.' . strtolower($name);
        $model    = 'App\\Models\\' . $name;
        $viewName = 'admin.pages.' . strtolower($name);

        $stub = str_replace('dummy_route', $route, $stub);
        $stub = str_replace('dummy_model', $model, $stub);
        $stub = str_replace('dummy_viewname', $viewName, $stub);

        return $this;
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceNameStrings($stub, $name)->replaceClass($stub, $name);
    }

    protected function getOptions()
    {
        return [
        ];
    }
}