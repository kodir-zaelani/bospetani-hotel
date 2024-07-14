<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHotelRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'thumbnail'  => ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
            'star_level' => ['required', 'string', 'max:255'],
            'address'    => ['required', 'string', 'max:255'],
            'link_gmaps' => ['required', 'string', 'max:255'],
            'address'    => ['required', 'string', 'max:255'],
            'city_id'    => ['required'],
            'country_id' => ['required'],
            'photo.*'    => ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
