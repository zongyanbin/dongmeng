<?php

//namespace App\Http\Requests;
namespace Rbac\Permission\Requests\AdminRole;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRoleRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|unique:admin_roles|max:200',
            'slug' => 'required|unique:admin_roles',
            'permissions'=>'required'
        ];
    }
    
}
