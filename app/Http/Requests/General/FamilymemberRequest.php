<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;


class FamilymemberRequest extends FormRequest
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
            'birth_date'=>'required|date|',
            'disability'=>'required|exists:disabilities,id',
            'email'=>'nullable|email', 
            'address'=>'required|string', 
            'phone_no'=>'nullable|numeric', 
            'relationship'=>'required|exists:familyrelationships,id',
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
            'email'=>'nullable|email', 
            'address'=>'required|string', 
            'phone_no'=>'nullable|numeric', 
            'relationship'=>'required|exists:familyrelationships,id',
        ];
       }
       default:break;
     }
    }
}
