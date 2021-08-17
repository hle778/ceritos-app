<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GameCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'playerX' => 'required|numeric|exists:players,id',
            'playerO' => 'required|numeric|exists:players,id',
            'same_players' => (Request::input('playerX') == Request::input('playerO')) ? 'required' : ''
        ];

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'playerX.required'  => 'El nombre del jugador es obligatorio.',
            'playerO.unique'  => 'El nombre del jugador ya existe.',
            'same_players.required' => 'Los jugadores no pueden ser iguales.'
        ];
    }
}
