<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // diaktifkan
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // atuean data yang boleh masuk
        return [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'name' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer'
        ];
    }
}
