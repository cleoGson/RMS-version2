<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class DurationunitRequest extends FormRequest
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
             'name'=>"required|string|unique:durationunits,name",
             'display_name'=>'required',
             'range_from'=>'nullable|integer',
             'out_of'=>'nullable|integer',
            
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'name'=>"required|string|unique:durationunits,id,$this->route('durationunit')->id",
            'display_name'=>'required',
            'range_from'=>'nullable|integer',
            'out_of'=>'nullable|integer',
        ];
       }
       default:break;
     }
    }
}
