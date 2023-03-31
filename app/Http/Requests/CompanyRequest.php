<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends LayoutRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'required',
            'address'=> 'required',
            'city'=> 'required',
            'country'=> 'required',
            'website'=> 'nullable',
            'phone'=> 'required',
            'description'=> 'nullable',
            'brand'=> 'nullable',
        ];
    }
}
