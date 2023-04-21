<?php

namespace App\Http\Requests;

class CandidateUpdateRequest extends LayoutRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'string',
            'address' => 'string',
            'city' => 'string',
            'country' => 'string',
            'birth_date' => 'date',
            'phone' => 'string',
            'resume' => 'nullable|mimes:pdf',
            'photo' => 'nullable|mimes:jpg,bmp,png',
            'user_id' => 'exists:users,id',
        ];
    }
}
