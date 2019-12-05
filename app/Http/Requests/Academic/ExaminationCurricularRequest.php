<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class ExaminationCurricularRequest extends FormRequest
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
           'name'=>"required|string",
           'year_id'=>'required|integer|exists:academicyears,id',
           'semester_id'=>'required|integer|exists:semesters,id',
           'examinationmark_id.*'=>'required|exists:examinationmarks,id',
       ];
      }
      case 'PUT':
      case 'PATCH':
      { 

       return [
           'name'=>"required|string",
           'year_id'=>'required|integer|exists:academicyears,id',
           'semester_id'=>'required|integer|exists:semesters,id',
           'examinationmark_id.*'=>'required|exists:examinationmarks,id',
           
       ];
      }
      default:break;
    }
   }
}
