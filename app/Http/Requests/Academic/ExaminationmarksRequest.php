<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class ExaminationmarksRequest extends FormRequest
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
            'examinationtype_id'=>'required|numeric|exists:examinationtypes,id',
            'marks'=>'required|numeric|max:100',
            'out_of'=>'required|numeric|max:100|greater_than:marks', 
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'examinationtype_id'=>'required|numeric|exists:examinationtypes,id',
            'marks'=>'required|numeric|max:100',
            'out_of'=>'required|numeric|max:100|greater_than:marks', 
        ];
       }
       default:break;
     }
    }
}
