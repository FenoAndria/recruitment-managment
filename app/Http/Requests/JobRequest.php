<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends LayoutRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'deadline' => 'nullable|date',
            'description' => 'nullable',
            'missions' => 'nullable',
            'profile_required' => 'nullable',
            'urgent' => 'boolean',
            'visibility' => 'boolean',
            'company_id' => 'exists:companies,id',
        ];
    }
}
