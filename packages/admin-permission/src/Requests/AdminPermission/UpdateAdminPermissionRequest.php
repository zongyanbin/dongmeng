<?php
//namespace App\Http\Requests;
namespace Rbac\Permission\Requests\AdminPermission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminPermissionRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $permissionId = $this->route('permission');
        return [
            'id'=>'exists:Rbac\Permission\Models\AdminPermission,id',
            'name'=>[
                'required',
                 Rule::unique('admin_permissions')->ignore($permissionId),
                'max:60'
            ],
            'slug'=>[
                'required',
                Rule::unique('admin_permissions')->ignore($permissionId),
                'max:100'
            ],
        ];
    }
}
