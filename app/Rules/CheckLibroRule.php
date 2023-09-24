<?php

namespace App\Rules;

use App\Models\Libro;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckLibroRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
      $libro_id = $value;
      $libro = Libro::find($libro_id);
      

      if (!$libro->disponible) {
        $fail('El libro seleccionado no está disponible');
      }
    }
}
