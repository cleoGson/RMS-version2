<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use App\Model\Classsetup;
use App\Model\Examinationcurricular;


class MarksvalidatorRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($semester_id,$classsetup_id,$examinationtnature_id,$message)
      {
        $this->semester_id=$semester_id;
        $this->classsetup_id=$classsetup_id; 
        $this->examinationtnature_id=$examinationtnature_id; 
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
        if(!is_null($this->classsetup_id) && !is_null($this->semester_id)){
         $setup_data=Classsetup::findOrFail($this->classsetup_id);
         $semisters=$setup_data->examinationCurriculars->pluck('semester_id','id')->toArray();
         $exam_curricular_id=(!is_null($semisters) & in_array($this->semester_id,$semisters)) ? $semisters[$this->semester_id] :null;
        
         if(!is_null($exam_curricular_id)){
         $examinations=Examinationcurricular::findOrFail($exam_curricular_id);
         $examinationtype=$examinations->examinationCurriculars->pluck('marks','examinationtype_id')->toArray();
         $max_marks=(!is_null($examinationtype) & array_key_exists($this->examinationtnature_id,$examinationtype)) ? $examinationtype[$this->examinationtnature_id] :null;
    
        if(!is_null($max_marks) &&  ($value<=$max_marks)){
            return true;
        }   
         $this->message = $this->message.$max_marks;
        return false;  
         }
         return false;
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
        return $this->message;
    }
}
