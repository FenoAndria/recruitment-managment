<?php

namespace App\Http\Requests;

class CandidatureUpdateRequest extends LayoutRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'status' => 'required|in:pending,interview,keeped,rejected',
        ];
    }
}
