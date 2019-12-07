<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class AtttachementRequest extends FormRequest
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
            'attachment_type'=>'required|integer|exists:attachmenttypes,id',
            'file'=>"required|file",
             'remarks'=>"nullable|string"
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'attachment_type'=>'required|integer|exists:attachmenttypes,id',
            'file'=>"required|file",
             'remarks'=>"nullable|string"
        ];
       }
       default:break;
     }
    }
}
