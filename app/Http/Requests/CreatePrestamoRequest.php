<?php

namespace App\Http\Requests;

use App\Rules\CheckLibroRule;
use Illuminate\Foundation\Http\FormRequest;

class CreatePrestamoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      return [
        'user_id'                   => 'required|numeric|max:20',
        'libro_id'                  => ['required', 'numeric', 'max:20', new CheckLibroRule],
        'fecha_prestamo'            => 'required|date|after_or_equal:today',
        'fecha_devolucion_estimada' => 'required|date|after:fecha_prestamo',
        'entregado'                 => 'required|boolean'
      ];
    }

    public function messages(){
      return [
        'user_id.required'                   => 'El campo usuario es obligatorio',
        'user_id.numeric'                    => 'Rellene el campo con un usuario válido',
        'user_id.max'                        => 'Rellene el campo con un usuario válido',
        'libro_id.required'                  => 'El campo libro es obligatorio',
        'libro_id.numeric'                   => 'Rellene el campo con un libro válido',
        'libro_id.max'                       => 'Rellene el campo con un libro válido',
        'fecha_prestamo.required'            => 'El campo Fecha Préstamo es obligatorio',
        'fecha_prestamo.date'                => 'Rellene el campo con una fecha válida',
        'fecha_prestamo.after_or_equal'      => 'La fecha de préstamo no puede ser anterior a la de hoy',
        'fecha_devolucion_estimada.required' => 'El campo Fecha Devolución Estimada es obligatorio',
        'fecha_devolucion_estimada.date'     => 'Rellene el campo con una fecha válida',
        'fecha_devolucion_estimada.after'    => 'La fecha de devolución estimada debe ser superior a la del préstamo',
        'entregado.required'                 => 'El campo entregado es obligatorio',
        'entregado.boolean'                  => 'Rellene el campo entregado correctamente'
      ];
    }
}
