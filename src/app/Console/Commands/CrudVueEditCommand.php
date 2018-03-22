<?php
/**
 * Created by PhpStorm.
 * User: idn-lee
 * Date: 18-3-19
 * Time: 上午9:06
 */

namespace DDVue\AdminPanel\app\Console\Commands;


use Illuminate\Console\GeneratorCommand;

class CrudVueEditCommand extends GeneratorCommand
{
    protected $name        = 'crud:vue-edit';
    protected $signature   = 'crud:vue-edit {name}';
    protected $description = '生成一个 CRUD 编辑 vue 组件';
    protected $type        = 'Vue';

    protected function getPath($name)
    {
        return $this->laravel['path'] . '/../resources/assets/js/components/admin/' . $name . '/edit.vue';
    }

    protected function getStub()
    {
        return __DIR__ . '/../stubs/crud-vue-edit.vue';
    }


    protected function replaceNameStrings(&$stub, $name)
    {

        $stub = str_replace('dummy_form_name', $name . 'EditForm', $stub);
        $stub = str_replace('dummy_name', 'Admin' . studly_case($name) . 'Edit', $stub);

        return $this;
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $name = strtolower($this->getNameInput());

        return $this->replaceNamespace($stub, $name)->replaceNameStrings($stub, $name)->replaceClass($stub, $name);
    }

    public function handle()
    {
        $name = strtolower($this->getNameInput());
        $path = $this->getPath($name);
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }
        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($name));
        $this->info($this->type . ' created successfully.');
    }
}