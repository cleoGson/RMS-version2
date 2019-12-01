<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
             'duration'=>'required|integer',
             'description'=>'required|string',
             'department_id'=>'required|exists:departments,id',
             'duration_unit'=>'required|exists:durationunits,id',
             'level_id'=>'required|exists:levels,id',
        ];
       }
       case 'PUT':
       case 'PATCH':
       { 

        return [
             'duration'=>'required|integer',
             'description'=>'required|string',
             'department_id'=>'required|exists:departments,id',
             'duration_unit'=>'required|exists:durationunits,id',
             'level_id'=>'required|exists:levels,id',
        ];
       }
       default:break;
     }
    }
}
