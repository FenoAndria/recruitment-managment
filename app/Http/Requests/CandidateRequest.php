<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends LayoutRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'nullable',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'bio' => 'nullable',
            'resume' => 'nullable|mimes:pdf',
            'photo' => 'nullable|mimes:jpg,bmp,png',
            'user_id' => 'exists:users,id',
        ];
    }
}
