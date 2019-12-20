<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Examinationresult;
class ResultPostingRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($semester_id,$class_id,$student_id,$examinationtype,$message)
      {
        $this->semester_id=$semester_id;
        $this->class_id =$class_id;
        $this->examinationtype=$examinationtype; 
        $this->student_id=$student_id; 
        $this->message = $message;
     }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
    $studed_validation=Examinationresult::where([
    ['academicyear_student_id','=',$this->student_id],
    ['semester_id','=',$this->semester_id],
    ['class_id','=',$this->class_id],
    ['examinationtype_id','=',$this->examinationtype],
    ['subject_id','=',$value]])->count();
    if($studed_validation<1){
        return true;
    }
    return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return  $this->message;
    }
}
