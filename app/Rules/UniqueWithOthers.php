<?php

namespace App\Rules;
use DB;
use Illuminate\Contracts\Validation\Rule;

class UniqueWithOthers implements Rule
{ public $otherColumn,$otherValue,$table,$message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table,$otherColumn,$otherValue,$message)
    {
        $this->table = $table;
        $this->otherColumn = $otherColumn;
        $this->otherValue = $otherValue;
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
                    ->where($this->otherColumn, $this->otherValue)
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
