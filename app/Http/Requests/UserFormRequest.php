<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Entrust;
use Auth;

class UserFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //@TODO check permission to create, edit user
        return Entrust::can('*-user') || $this->get('id') == Auth::user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'required|email|unique:users,email,'.$this->get('id'),
            'password'      => 'required_without:id|confirmed|min:6',
            'thumbnail'     => 'image:jpeg,png,bmp',
            'roles'         => 'exists:roles,id',
            'name'          => 'required|min:3'
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => ':attribute này đã đưọc đăng ký',
            'password.required_without'  => 'Mật khẩu không được bỏ trống',
            'roles.exists' => 'Quyền được cấp không tồn tại'
        ];
    }
}
