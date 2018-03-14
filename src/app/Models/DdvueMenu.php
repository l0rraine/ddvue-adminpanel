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

    protected $fillable = ['title', 'index', 'type', 'icon', 'owners', 'sort_id', 'parent_id', 'class_list', 'class_layer'];

    protected $casts = ['owners' => 'array'];

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
        $roleModelName = config('ddvue.adminpanel.page_settings.role.model');
        $role          = new $roleModelName();
        $user          = Auth::user();
        $menu          = collect();
        foreach ($this->get() as $m) {
            $r = $role->whereIn('id', $m['owners'] ?? [])->pluck('id');
            if ($r->count() && !$user->hasRole($r) && $m['type'] == 'item') {
                $menu->push($m);
            }
        }

        $menu = $this->buildTree($this->get()->toArray(),0,$menu);

        return $menu;


    }


    private function buildTree(array $elements, $parentId = 0, Collection $menus)
    {
        $branch = [];
        foreach ($elements as $element) {
            $element = $this->extraActionWhenRecurse($element);
            if ($element['parent_id'] == $parentId) {
                $c = $menus->pluck('class_list')->search(function ($item) use ($element) {
                    return strpos($item, $element['class_list']) === 0;
                });
                if (!is_bool($c)) {
                    $children            = $this->buildTree($elements, $element['id'],$menus);
                    $element['children'] = $children;
                    $branch[]            = $element;
                }

            }

        }

        return $branch;
    }


}
