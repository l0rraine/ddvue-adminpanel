<?php

namespace DDVue\AdminPanel\app\Models;

use DDVue\Crud\app\Models\BaseClassifiedModel;
use DDVue\Crud\ModelTraits\BaseModelTrait;
use Illuminate\Support\Facades\Route;

class DdvueMenu extends BaseClassifiedModel
{
    use BaseModelTrait;

    protected $table = 'ddvue_menus';

    public static function rules($id = 0, $merge = [])
    {
        return array_merge([
            'title'     => 'required',
            'parent_id' => 'required',
        ], $merge);
    }

    public static function messages($id = 0, $merge = [])
    {
        return array_merge([
            'title.required'     => '必须填写标题',
            'parent_id.required' => '必须选择父节点！',
        ], $merge);
    }

    public static function setIndexAuto()
    {
        foreach (self::all() as $k => $v) {
            if(array_key_exists('index',$v)){
                if ($v['index'] == '') {
                    $index = substr($v['class_list'], 1, strlen($v['class_list']) - 2);
                    $arr   = explode(',', $index);
                    $index = join('-', $arr);
                    $v->update(['index' => $index]);
                }
            }

        }
    }

    public function extraActionWhenRecurse(array $arr)
    {

        if(array_key_exists('index',$arr) && Route::has($arr['index'])) {
            $arr['index']=route($arr['index']);
        }
        return $arr;
    }
}
