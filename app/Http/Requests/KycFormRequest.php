<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KycFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;//Auth::user()->hasVerifiedEmail();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'adresse' => 'required|string',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'lieu_naissance' => 'required|string',
            'date_naissance' => 'required|date',
            'nationalite' => 'required|string',
            'profession' => 'required|string',
            'type_piece' => 'required|string',
            'piece_identite' => 'required|file',
            'numero_piece_identite' => 'required|string',
            'photo' => 'required|file',
            'numero_telephone' => 'required|string'
        ];
    }
}
