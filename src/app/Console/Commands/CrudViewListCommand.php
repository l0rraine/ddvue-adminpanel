<?php
/**
 * Created by PhpStorm.
 * User: idn-lee
 * Date: 18-3-19
 * Time: 上午9:06
 */

namespace DDVue\AdminPanel\app\Console\Commands;


use Illuminate\Console\GeneratorCommand;

class CrudViewListCommand extends GeneratorCommand
{
    protected $name        = 'crud:view-list';
    protected $signature   = 'crud:view-list {name}';
    protected $description = '生成一个 CRUD 列表 view';
    protected $type        = 'View';

    protected function getPath($name)
    {
        $name = $this->getNameInput();
        return $this->laravel['path'] . '/../resources/views/admin/pages/' . $name . '/list.blade.php';
    }

    protected function getStub()
    {
        return __DIR__ . '/../stubs/crud-view-list.blade.php';
    }


    protected function replaceNameStrings(&$stub, $name)    {

        $stub = str_replace('dummy', $name, $stub);

        return $this;
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $name = $this->getNameInput();

        return $this->replaceNamespace($stub, $name)->replaceNameStrings($stub, $name)->replaceClass($stub, $name);
    }

    public function handle()
    {
        $name = $this->getNameInput();
        $path = $this->getPath($name);
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');
            return false;
        }
        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($name));
        $this->info($this->type.' created successfully.');
    }
}