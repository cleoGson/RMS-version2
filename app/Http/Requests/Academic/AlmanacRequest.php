<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class AlmanacRequest extends FormRequest
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
            'description'=>'nullable|string',
            'start_date'=>"required|date",
            'end_date'=>'required|date|after:start_date',
            'center_id'=>'nullable|integer|exists:centers,id',
            'year_id'=>'required|integer|exists:academicyears,id',
            'event_id'=>'required|integer|exists:events,id',
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'description'=>'nullable|string',
            'start_date'=>"required|date",
            'end_date'=>'required|date|after:start_date',
            'center_id'=>'nullable|integer|exists:centers,id',
            'year_id'=>'required|integer|exists:academicyears,id',
            'event_id'=>'required|integer|exists:events,id',
        ];
       }
       default:break;
     }
    }
}
