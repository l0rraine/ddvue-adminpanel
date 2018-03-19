<?php
/**
 * Created by PhpStorm.
 * User: idn-lee
 * Date: 18-3-19
 * Time: 上午9:06
 */

namespace DDVue\AdminPanel\app\Console\Commands;


use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CrudModelCommand extends GeneratorCommand
{
    protected $name        = 'crud:model';
    protected $signature   = 'crud:model {name}';
    protected $description = '生成一个 CRUD 模型';
    protected $type        = 'Model';

    protected function getPath($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }

    protected function getStub()
    {
        return __DIR__ . '/../stubs/crud-model.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models';
    }

    protected function replaceNameStrings(&$stub, $namespace)
    {
        $name = explode('\\', $namespace);
        $name = array_pop($name);

        $table = Str::snake(Str::plural($name));


        $stub = str_replace('DummyTable', $table, $stub);


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