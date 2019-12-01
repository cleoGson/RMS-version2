<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class FeesamountRequest extends FormRequest
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
            'year_id'=>'required|integer|exists:academicyears,id',
            'fees_id'=>'required|integer|exists:fees,id',
            'amount'=>'required|numeric',
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
             'year_id'=>'required|integer|exists:academicyears,id',
            'fees_id'=>'required|integer|exists:fees,id',
            'amount'=>'required|numeric',
        ];
       }
       default:break;
     }
    }
}
