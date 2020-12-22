<?php
namespace Addons\Articles\Requests\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
        return [
          'title'=>'required|unique:categories|max:30',
          'name'=>'required'
         ];
    }

    public function messages()
    {
        return [
            'title.required'=>'栏目名称不能为空',
            'title.unique' =>'栏目已经存在'
        ];
    }
}
