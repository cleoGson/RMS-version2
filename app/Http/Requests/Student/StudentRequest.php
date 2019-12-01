<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'firstname'=>'required|string|max:191',
            'middlename'=>'required|string|max:191',
            'lastname'=>'required|string|max:191',
            'sex'=>'required|in:female,male',
            'phone_no'=>'nullable|numeric',
            'address'=>'required|string',  
            'birth_date'=>'required|date',
            'disability'=>'required|exists:disabilities,id',
            'blood_group'=>'nullable|exists:bloodgroups,id',
            'birth_place'=>'required|string',
            'birth_country'=>'required|exists:countries,id',
            'citizenship'=>'required|exists:countries,id',
            'course'=>'required|exists:courses,id',
            'email'=>'nullable|email', 
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'firstname'=>'required|string|max:191',
            'middlename'=>'required|string|max:191',
            'lastname'=>'required|string|max:191',
            'sex'=>'required|in:female,male',
            'phone_no'=>'nullable|numeric',
            'address'=>'required|string',  
            'birth_date'=>'required|date',
            'disability'=>'required|exists:disabilities,id',
            'blood_group'=>'nullable|exists:bloodgroups,id',
            'birth_place'=>'required|string',
            'birth_country'=>'required|exists:countries,id',
            'citizenship'=>'required|exists:countries,id',
            'course'=>'required|exists:courses,id',
            'email'=>'nullable|email', 

        ];
       }
       default:break;
     }
    }
}
