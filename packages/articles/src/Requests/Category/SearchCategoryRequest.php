<?php

namespace Addons\Articles\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class SearchCategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword'=>'string'
        ];
    }
}
