<?php

namespace DDVue\AdminPanel\app\Models;

use DDVue\Crud\app\Models\BaseClassifiedModel;
use DDVue\Crud\ModelTraits\BaseModelTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class DdvueMenu extends BaseClassifiedModel
{
    use BaseModelTrait;

    protected $table = 'ddvue_menus';

    protected $fillable = ['title', 'index', 'type', 'icon', 'limits', 'sort_id', 'parent_id', 'class_list', 'class_layer'];

    protected $casts = ['limits' => 'array'];

    public static function rules($id = 0, $merge = [])
    {
        return array_merge([
            'title'     => 'required',
            'parent_id' => 'required',
            'type'      => 'required'
        ], $merge);
    }

    public static function messages($id = 0, $merge = [])
    {
        return array_merge([
            'title.required'     => '必须填写标题',
            'parent_id.required' => '必须选择父节点',
            'type.required'      => '必须填写菜单类型'
        ], $merge);
    }

    public static function setIndexAuto()
    {
        foreach (self::all() as $k => $v) {
            $v->setIndex(false);

        }
    }

    public function setIndex($only_new = true)
    {
        $m = $this->find($this->id);
        if (array_key_exists('index', $m->toArray())) {
            if (!Route::has($m->index)) {
                if (!$only_new || empty($this->index)) {
                    $index = substr($m->class_list, 1, strlen($m->class_list) - 2);
                    $arr   = explode(',', $index);
                    $index = join('-', $arr);
                    $m->update(['index' => $index]);
                }

            }
        }
    }

    public function extraCondition(array $arr)
    {
        //TODO:增加权限判断
//        if(Auth::user()->hasAnyRole(DdvRole::all())){
//            return true;
//        }
        return true;
    }


    public function extraActionWhenRecurse(array $arr)
    {

        if (array_key_exists('index', $arr) && Route::has($arr['index'])) {
            $arr['index'] = route($arr['index']);
        }

        return $arr;
    }

    public function doAfterCU($data)
    {
        parent::doAfterCU($data);
        self::setIndex();
    }

    public function getSelectArrayByParentId($pid = 0, $show_root = false, $arr = null)
    {

        $user = Auth::user();
        $menu = collect();
        $datas  = $this->getAllByParentId($pid, $show_root);
        foreach ( $datas as $m) {
            $limits = $m['limits'] ?? [];
            if ((count($limits) == 0 || $user->hasAnyPermission($limits))) {  //&& $m['type'] == 'item'
                $menu->push($m);
            }
        }
        if ($pid == 0 && $show_root) {
            $pid = -1;
        }

        $menu = $this->buildTree($menu, $pid);

        return $menu;


    }


    protected function buildTree(Collection $elements, $parentId = 0)
    {
        $branch = [];

        foreach ($elements as $element) {
            if($this->extraCondition($element)){
                $element = $this->extraActionWhenRecurse($element);
                if ($element['parent_id'] == $parentId) {
                    $children            = $this->buildTree($elements, $element['id']);
                    $element['children'] = $children;
                    $branch[]            = $element;
                }
            }

        }

        return $branch;
    }


}
