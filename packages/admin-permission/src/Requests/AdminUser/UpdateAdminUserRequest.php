<?php
/**
 * 表单请求层
 */
//namespace App\Http\Requests;
namespace Rbac\Permission\Requests\AdminUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
class UpdateAdminUserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
     /**
      * 资源更新例如 /users/1
      */
        $userId = $this->route('user');
        return [
            'id'=>'exists:Rbac\Permission\Models\AdminUser,id',// 模型层命名空间 判断数据表是否有 id
            'username'=>[
                'required',
                 Rule::unique('admin_users')->ignore($userId), //username 提交数据表必须是唯一，这个唯一 必须排除自己
                'max:30'
            ],
            'name'=>'required',
            'mobile'=>'required',
            'password'=>'required|min:6',
            'roleIds'=>'required'
        ];
    }
    /**
     * 
     * 配置验证实例
     *
     * @param [type] $validator
     * @return void
     */
    public function withValidator($validator)
    {
      
        //判断有errors直接return
        if($validator->errors()->all()){
            return;
        }
     
        $password = $this->input('password'); //获取当前请求的password

        //拿到$password就去function里
        $validator->after(function($validator) use ($password){
            $password = bcrypt($password);//给$password 加密重新赋值
            $this->merge([   //通过merge方法把当前密码覆盖下
                'password'=>$password
            ]);

        });
    }
}
