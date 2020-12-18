<?php
namespace Rbac\Permission\Requests\AdminMenu;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminMenuRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'path' => 'required|unique:admin_menus',
            'parent_id' => 'exists:Rbac\Permission\Models\AdminMenu,id',
            'roles' => 'required'
        ];
    }
}
