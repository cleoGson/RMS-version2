<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class FeesstructureRequest extends FormRequest
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
             'name'=>"required|string",
             'feeamount_id'=>"required|array|min:1",
             'feeamount_id.*'=>'required|integer|distinct|exists:feesamounts,id',
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'name'=>"required|string",
            'feeamount_id'=>"required|array|min:1",
            'feeamount_id.*'=>'required|integer|distinct|exists:feesamounts,id',
        ];
       }
       default:break;
     }
    }
}
