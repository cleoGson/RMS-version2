<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class GradeCurricularRequest extends FormRequest
{ /**
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
           'name'=>"required|string|unique:gradecurriculars,name",
           'display_name'=>'nullable|string',
           'year_id'=>'required|integer|exists:academicyears,id',
           'grademarks_id'=>"required|array|min:1",
           'grademarks_id.*'=>'required|integer|distinct|exists:grademarks,id',
       ];
      }
      case 'PUT':
      case 'PATCH':
      { 

       return [
           'name'=>"required|string|unique:gradecurriculars,id,$this->route('gradecurricular')->id",
           'display_name'=>'nullable|string',
           'year_id'=>'required|integer|exists:academicyears,id',
           'grademarks_id'=>"required|array|min:1",
           'grademarks_id.*'=>'required|integer|distinct|exists:grademarks,id',
           
       ];
      }
      default:break;
    }
   }
}
