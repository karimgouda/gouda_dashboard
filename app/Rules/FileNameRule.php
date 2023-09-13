<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileNameRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private string $targetFileName)
    {
        $this->targetFileName = $targetFileName;
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
        return strtolower($value->getClientOriginalName()) == strtolower($this->targetFileName);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute name should be ' . $this->targetFileName;
    }
}
