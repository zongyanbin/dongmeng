<?php

//namespace App\Http\Requests;
namespace Rbac\Permission\Requests\AdminRole;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRoleRequest extends FormRequest
{

    public function rules()
    {
        $roleId = $this->route('role');
        return [
            'id' => 'exists:Rbac\Permission\Models\AdminRole,id',// 模型层命名空间 判断数据表是否有 id
            'name'=>['required',Rule::unique('admin_roles')->ignore($roleId)], //name 提交数据表必须是唯一，这个唯一 必须排除自己
            'slug'=>['required',Rule::unique('admin_roles')->ignore($roleId)],
            'permissions'=>'required'
        ];
    }
}
