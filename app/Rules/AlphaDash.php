<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaDash implements Rule
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
        return !preg_match('/[^a-z\s-]/i',$value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must only contain alphabet, space and dash.';
    }
}
