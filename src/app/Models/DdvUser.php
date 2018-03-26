<?php

namespace DDVue\AdminPanel\app\Models;

use DDVue\Crud\ModelTraits\BaseModelTrait;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Exceptions\GuardDoesNotMatch;
use Spatie\Permission\Traits\HasRoles;

class DdvUser extends Authenticatable
{
    use Notifiable, HasRoles, BaseModelTrait;

    protected $table = 'users';

    protected $with = ['roles', 'department'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'displayname', 'email', 'password','dep_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];


    public function department()
    {
        return $this->hasOne(config('ddvue.adminpanel.page_settings.department.model'), 'id', 'dep_id');
    }

    public static function rules($id = 0, $merge = [])
    {
        return array_merge([
            'password_confirmation' => 'same:password',
        ], $merge);
    }

    public static function messages($id = 0, $merge = [])
    {
        return array_merge([
            'password_confirmation.same' => ' 两次输入密码不一致!'
        ], $merge);
    }

    public function doAfterCU($data = [])
    {
        if(!isset($data['password'])){
            $this->resetPassword($data['password']);
        }

        $this->syncRoles($data['roles']);


    }


    function resetPassword($password)
    {
        $this->password = Hash::make($password);
        $this->setRememberToken(Str::random(60));
        $this->save();
        event(new PasswordReset($this));
    }




//    protected function ensureModelSharesGuard($roleOrPermission)
//    {
//        //多个guard共用一个role或permission
//        $g = explode(',', $roleOrPermission->guard_name);
//        if (count($g) > 1) {
//            $g = collect($g)->sort()->filter(function ($value, $key) {
//                return $value != '';
//            })->implode(',');
//
//            if ($this->getGuardNames()->sort()->implode(',') != $g) {
//                throw GuardDoesNotMatch::create($roleOrPermission->guard_name, $this->getGuardNames());
//            }
//
//
//        } else {
//            if (!$this->getGuardNames()->contains($roleOrPermission->guard_name)) {
//                throw GuardDoesNotMatch::create($roleOrPermission->guard_name, $this->getGuardNames());
//            }
//        }
//
//    }

}
