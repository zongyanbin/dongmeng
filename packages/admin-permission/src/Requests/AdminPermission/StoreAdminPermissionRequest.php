<?php

//namespace App\Http\Requests;
namespace Rbac\Permission\Requests\AdminPermission;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminPermissionRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:admin_permissions|max:60',
            'slug' => 'required|unique:admin_permissions|max:100',
            'description'=>'required'
        ];
    }
}
