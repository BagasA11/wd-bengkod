<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailDomain implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
         //
        $email = strval($value);
        $domain = explode('@', $email)[1]; //user@domain.com => user, domain.com
        if (count( explode('.', $domain) ) < 2){
             $fail('The :attribute domain is invalid');
        }
    }
}
