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
            'name'=>"required|string|unique:studentstatuses,name",
            'display_name'=>'required',
            'firstname'=>'required|string|max:191',
            'middlename'=>'required|string|max:191',
            'lastname'=>'required|string|max:191',
            'sex'=>'required|in:female,male',
            'birth_date'=>'required|date|',
            'disability'=>'required|exists:disabilities,id',
            'birth_place'=>'required|string',
            'email'=>'nullable|email', 
            'address'=>'required|string', 
            'phone_no'=>'nullable|numeric', 
            'birth_country'=>'required|exists:countries,id',
            'blood_group'=>'nullable|exists:bloodgroups,id',
            'citizenship'=>'required|exists:countries,id',
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
            'birth_date'=>'required|date',
            'disability'=>'required|exists:disabilities,id',
            'birth_place'=>'required|string',
            'email'=>'nullable|email', 
            'address'=>'required|string', 
            'phone_no'=>'nullable|numeric', 
            'birth_country'=>'required|exists:countries,id',
            'blood_group'=>'nullable|exists:bloodgroups,id',
            'citizenship'=>'required|exists:countries,id',
        ];
       }
       default:break;
     }
    }
}
