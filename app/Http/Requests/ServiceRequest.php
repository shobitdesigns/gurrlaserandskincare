<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'is_laser_option' => 'nullable|boolean',
        ];

        if (!$this->input('is_laser_option')) {
            $rules['duration'] = 'required|string|max:255';
            $rules['description'] = 'required|string';
        }

        return $rules;
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'         => 'The name is required.',
            'duration.required'     => 'The duration is required.',
            'price.required'        => 'The price is required.',
            'price.numeric'         => 'The price must be a valid number.',
            'image.image'           => 'The uploaded file must be an image.',
            'image.mimes'           => 'The image must be a file of type: jpeg, jpg, png.',
            'image.max'             => 'The image must not exceed 2MB.',
        ];
    }
}
