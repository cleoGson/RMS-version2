<?php

namespace App\Http\Requests\Academic;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
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
           'name'=>"required|string|unique:grades,name",
           'display_name'=>'required',
           'remarks'=>'required|string',
           'point'=>'required|integer',
       ];
      }
      case 'PUT':
      case 'PATCH':
      { 

       return [
           'name'=>"required|string|unique:grades,id,$this->route('grade')->id",
           'display_name'=>'required',
           'remarks'=>'required|string',
           'point'=>'required|integer',
       ];
      }
      default:break;
    }
   }
}
