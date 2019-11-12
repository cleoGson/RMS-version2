<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class AcademicYearRequest extends FormRequest
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
            'name'=>"required|string|unique:academicyears,name",
            'start_date'=>"required|date",
            'end_date'=>'required|date|after:start_date',
         
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'name'=>"required|string|unique:academicyears,id,$this->route('academicyear')->id",
            'start_date'=>"required|date",
            'end_date'=>'required|date|after:start_date',
            'status'=>'required|string|in:Pending,Open, Close',
        ];
       }
       default:break;
     }
    }
}
