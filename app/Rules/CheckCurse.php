<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCurse implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $curses = collect(["fuck", 'ass', 'shit']);
        if ($curses->filter(function ( $curse) use ($value) {
            return is_bool(strpos(trim($value) , $curse)) ? false : true;
        })->count() > 0) {
            $fail('You are not allowed to make dirty comments');
        }
    }
}
