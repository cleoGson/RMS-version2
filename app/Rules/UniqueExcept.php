<?php

namespace App\Rules;
use DB;
use Illuminate\Contracts\Validation\Rule;

class UniqueExcept implements Rule
{
   /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table,$idColumnName,$exceptId,$message)
    {
        $this->table = $table;
        $this->idColumnName=$idColumnName;
        $this->exceptId=$exceptId; 
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
         $count = DB::table($this->table)
                    ->where($attribute,  $value)
                    ->where($this->idColumnName,'!=',$this->exceptId)
                    ->count();
            return $count == 0;
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
