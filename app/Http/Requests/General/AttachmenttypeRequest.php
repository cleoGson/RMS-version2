<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class AttachmenttypeRequest extends FormRequest
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
            'name'=>"required|string|unique:attachmenttypes,name",
            'display_name'=>'required',
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'name'=>"required|string|unique:attachmenttypes,id,$this->route('attachmenttype')->id",
            'display_name'=>'required',
        ];
       }
       default:break;
     }
    }
}
