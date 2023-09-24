<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLibroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'titulo'           => 'required|max:255',
            'autor'            => 'required|max:255',
            'descripcion'      => 'required',
            'anio_publicacion' => 'required|numeric|max_digits:4',
            'genero'           => 'required|max:255',
            'disponible'       => 'required|boolean'
          ];
    }

    /**
     * Error messages when Validation fails
     */
    public function messages(){
        return [
          'titulo.required'             => 'El título es un campo obligatorio',
          'titulo.max'                  => 'El título debe contener como máximo 255 carácteres',
          'autor.required'              => 'El autor es un campo obligatorio',
          'autor.max'                   => 'El autor debe contener como máximo 255 carácteres',
          'descripcion.required'        => 'La descripción es un campo obligatorio',
          'anio_publicacion.required'   => 'El año de publicación es un campo obligatorio',
          'anio_publicacion.numeric'    => 'El año de publicación debe ser un campo numérico',
          'anio_publicacion.max_digits' => 'El año de publicación debe contener como máximo 4 dígitos',
          'genero.required'             => 'El género es un campo obligatorio',
          'genero.max'                  => 'El género debe contener como máximo 255 carácteres',
          'disponible.required'         => 'El campo disponible es obligatorio',
          'disponible.boolean'          => 'Rellene el campo disponible correctamente'
        ];
      }
}
