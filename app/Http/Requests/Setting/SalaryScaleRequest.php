<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SalaryScaleRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function rules() 
    {
        $mindata =intval(request()->input('min_paymemt'))+1;
        switch($this->method()){ 
        case 'GET':
        case 'DELETE':
        {
            return [];
        }
        case 'POST':
        {
        return [
            'name'=>"required|string|unique:salaryscales,name|max:191",
            'display_name'=>'required',
            'min_payment'=>'nullable|numeric|min:0',
            'max_payment'=>"nullable|numeric|min:$mindata",
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 
      
        return [
            'name'=>"required|string|max:191|unique:salaryscales,id,$this->route('salaryscale')->id",
            'display_name'=>'required',
            'min_payment'=>'nullable|numeric|min:0',
            'max_payment'=>"nullable|numeric|min:$mindata",

        ];
       }
       default:break;
     }
    }
}
