<?php
/**
 * 表单请求层
 */
//namespace App\Http\Requests;
namespace Rbac\Permission\Requests\AdminUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
class StoreAdminUserRequest extends FormRequest
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
        return [
            'username'=>'required|unique:admin_users|max:30',
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
