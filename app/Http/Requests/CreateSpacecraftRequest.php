<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSpacecraftRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:spacecraft',
            'height' => 'required|numeric',
            'diameter' => 'required|numeric',
            'payload' => 'required',
            'image' => 'required|mimetypes:image/png,image/jpeg'
        ];
    }
}
