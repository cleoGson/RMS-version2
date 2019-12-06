<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class CurricularRequest extends FormRequest
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
            'name'=>"required|string|unique:curriculars,name",
            'semester_id'=>'required|exists:semesters,id',
            'year_id'=>'required|integer|exists:academicyears,id',
            'subjects_id'=>"required|array|min:1",
            'subjects_id.*'=>'required|integer|distinct|exists:subjects,id',
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'name'=>"required|string|unique:curriculars,id,$this->route('curricular')->id",
            'semester_id'=>'required|exists:semesters,id',
            'year_id'=>'required|integer|exists:academicyears,id',
            'subjects_id'=>"required|array|min:1",
            'subjects_id.*'=>'required|integer|distinct|exists:subjects,id',
        ];
       }
       default:break;
     }
    }

}
