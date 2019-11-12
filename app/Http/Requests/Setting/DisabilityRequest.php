<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class DisabilityRequest extends FormRequest
{  /**
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
           'name'=>"required|string|unique:disabilities,name",
           'display_name'=>'required',
       ];
      }
      case 'PUT':
      case 'PATCH':
      { 

       return [
           'name'=>"required|string|unique:disabilities,id,$this->route('disability')->id",
           'display_name'=>'required',
       ];
      }
      default:break;
    }
   }
}
