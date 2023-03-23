<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\LayoutRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ];
    }
}
