<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
        switch($this->method()){ 
        case 'GET':
        case 'DELETE':
        {
            return [];
        }
        case 'POST':
        {
        return [
             'name'=>"required|string|unique:countries,name",
             'display_name'=>"required",
             'code'=>'required|unique:countries,code',
             'monetary'=>'required',
             'monetary_short_name'=>'required',
             'monetary_sign'=>'nullable',

        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'name'=>"required|string|unique:countries,id,$this->route('country')->id",
            'display_name'=>"required",
            'code'=>"required|unique:countries,id,$this->route('country')->id",
            'monetary'=>'required',
            'monetary_short_name'=>'required',
            'monetary_sign'=>'nullable',
        ];
       }
       default:break;
     }
    }
}
