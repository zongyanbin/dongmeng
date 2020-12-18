<?php
/**
 * 表单请求层
 */
//namespace App\Http\Requests;
namespace Rbac\Permission\Requests\AdminUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
class SearchAdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return true;
    // }
    
    public function rules()
    {
        return [
            'keyword'=>'string',
        ];
    }
}
