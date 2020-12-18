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
          'title'=>'required|max:30',
          'name'=>'required'
         ];
    }
}
