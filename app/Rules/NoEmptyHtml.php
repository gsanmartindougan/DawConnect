<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class NoEmptyHtml implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        //con ayuda de chatGPT
        // Verifica que el valor no sea "<p><br></p>"
        $valueWithoutTags = strip_tags($value);

        // Eliminar espacios en blanco y &nbsp;
        $valueWithoutSpaces = preg_replace('/\s|&nbsp;/', '', $valueWithoutTags);
        //dd($valueWithoutSpaces);
        if($valueWithoutSpaces === ''){
            return false;
        }else{
            return true;
        }

    }
    public function message()
    {
        return '¡Escribe algo!';
    }
}
