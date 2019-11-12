<?php

namespace App\Rules;
use Hash;
use Auth;
use Illuminate\Contracts\Validation\Rule;

class PasswordMatches implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
    $samepass=Hash::check($value,Auth::user()->password);
    if($samepass){
        return false;
    }
    else{
        return true;
    }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'New password should be difference with the existing password.';
    }
}
