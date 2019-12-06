<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class GradeMarkRequest extends FormRequest
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
            'name'=>"required|string|unique:grademarks,name",
            'grade_id'=>'required|integer|exists:grades,id',
            'minimum_marks'=>'required|numeric|max:100',
            'maximum_marks'=>'required|numeric|max:100|greater_than:minimum_marks', 
            'grade_point'=>'required|numeric|max:100',
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            'name'=>"required|string|unique:grademarks,id,$this->route('grademark')->id",
            'grade_id'=>'required|integer|exists:grades,id',
            'minimum_marks'=>'required|numeric|max:100',
            'maximum_marks'=>'required|numeric|max:100|greater_than:minimum_marks', 
            'grade_point'=>'required|numeric|max:100',
        ];
       }
       default:break;
     }
    }
}
