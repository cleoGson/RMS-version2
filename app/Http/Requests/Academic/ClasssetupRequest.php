<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class ClasssetupRequest extends FormRequest
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
            'name'=>'required|string|unique:classsetups,name',
            'class_id'=>'nullable|integer|exists:classrooms,id',
            'year_id'=>'required|integer|exists:academicyears,id',
            'minimum_capacity'=>'required|numeric|max:100',
            'maximum_capacity'=>'required|numeric|max:100|greater_than:minimum_capacity', 
            'classsection_id'=>'required|integer|exists:classsections,id',
            'grade_curricular'=>'required|integer|exists:gradecurriculars,id',
            'curricular_id'=>'required|integer|exists:curriculars,id',
            'feesstructure_id'=>'required|integer|exists:feesstructures,id',
            
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
            
            'name'=>"required|string|unique:classsetups,id,$this->route('classsetup')->id",
            'class_id'=>'nullable|integer|exists:classrooms,id',
            'year_id'=>'required|integer|exists:academicyears,id',
            'minimum_capacity'=>'required|numeric',
            'maximum_capacity'=>'required|numeric|greater_than:minimum_marks', 
            'classsection_id'=>'required|integer|exists:classsections,id',
            'grade_curricular'=>'required|integer|exists:gradecurriculars,id',
            'curricular_id'=>'required|integer|exists:curriculars,id',
            'feesstructure_id'=>'required|integer|exists:feesstructures,id',
            
        ];
       }
       default:break;
     }
    }
    
}
