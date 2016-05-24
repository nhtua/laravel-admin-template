<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Models\MyModelTrait;
use App\Models\Role;

class User extends Authenticatable
{
    use EntrustUserTrait, MyModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'status', 
        'full_name', 
        'phone',
        'address',
    ];

    protected $guarded = ['id', 'password'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ]; 

    const ATTR_BANNED = 1;
    const STT_INACTIVE = 1;
    const STT_PENDING   = 2;
    const STT_ACTIVE    = 3;

    public static function getLabels()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'password' => 'Password',
            'password_current' => 'Current Password',
            'password_confirmation' => 'Confirm Password',
            'avatar' => 'Avatar',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
            'status' => 'Status',
            'attr' => 'Attributes',
            'roles' => 'Roles',
        ];
    }
    public function getRoleOptions() {
        $roles = Role::all();
        $html = "";
        foreach ($roles as $key => $role) {
            $tmp = '<div class="radio"><label><input type="checkbox" #checked# value="#value#" class="flat" name="roles[#order#]"> #display_name#</label></div>';
            $tmp = str_replace('#checked#', $this->hasRole($role->name)?'checked':'', $tmp);
            $tmp = str_replace('#value#', $role->id, $tmp);
            $tmp = str_replace('#order#', $key, $tmp);
            $tmp = str_replace('#display_name#', $role->display_name, $tmp);
            $html .= $tmp;
        }
        return $html;
    }
    public function getAttrOptions()
    {
        $attributes = [
            self::ATTR_BANNED => 'Khóa tài khoản',
        ];
        $html = "";
        $i = 0;
        foreach ($attributes as $key => $value) {
            $tmp = '<div class="radio"><label><input type="checkbox" #checked# value="#value#" class="flat" name="attr[#order#]"> #display_name#</label></div>';
            $tmp = str_replace('#checked#', ($this->attr & $key) > 0 ?'checked':'', $tmp);
            $tmp = str_replace('#value#', $key, $tmp);
            $tmp = str_replace('#order#', $i++, $tmp);
            $tmp = str_replace('#display_name#', $value, $tmp);
            $html .= $tmp;
        }
        return $html;
    }
    public function getStatusOptions($default = NULL)
    {
        $attributes = [
            self::STT_ACTIVE => 'Active',
            self::STT_PENDING => 'Pending',
            self::STT_INACTIVE => 'Inactive',
        ];
        $html = '';
        foreach ($attributes as $key => $value) {
            $tmp = '<option value="#value#" #selected#> #display_name#</option>';
            $tmp = str_replace('#value#', $key, $tmp);
            $tmp = str_replace('#selected#', ($key == $default ? 'selected' : ''), $tmp);
            $tmp = str_replace('#display_name#', $value, $tmp);
            $html .= $tmp;
        }
        return $html;
    }
    public function isBanned()
    {
        return $this->status == self::STT_INACTIVE;
    }
}