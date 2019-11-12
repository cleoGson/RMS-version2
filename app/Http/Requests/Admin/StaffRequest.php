<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'sex'=>'required|string|in:female,male',
            'marital_status'=>'required|exists:maritals,id',
            'birth_date'=>'required|date|string',
            'disability'=>'required|exists:disiabilities,id',
            'birth_place'=>'required|string',
            'email'=>'required|email|unique:staffs,email',
            'address'=>'required|string',
            'phone_no'=>'required|numeric',
            'check_no'=>'nullable|string',
            'birth_country'=>'required|exists:countries,id',
            'citzenship'=>'required|exists:countries,id',
            'department_id'=>'required|exists:departments,id',
            'designation_id'=>'required|exists:designations,id',
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'firstname'=>'required|string|max:191',
            'middlename'=>'required|string|max:191',
            'lastname'=>'required|string|max:191',
            'sex'=>'required|string|in:female,male',
            'marital_status'=>'required|exists:maritals,id',
            'birth_date'=>'required|date|string',
            'disability'=>'required|exists:disiabilities,id',
            'birth_place'=>'required|string',
            'email'=>"required|email|unique:staffs,id,$this->route('staff')->id",
            'address'=>'required|string',
            'phone_no'=>'required|numeric',
            'check_no'=>'nullable|string',
            'birth_country'=>'required|exists:countries,id',
            'citzenship'=>'required|exists:countries,id',
            'department_id'=>'required|exists:departments,id',
            'designation_id'=>'required|exists:designations,id',
        ];
       }
       default:break;
     }
    }
}

