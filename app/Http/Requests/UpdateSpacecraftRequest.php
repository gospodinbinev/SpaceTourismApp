<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSpacecraftRequest extends FormRequest
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
            'name' => 'required',Rule::unique('spacecraft')->ignore($this),
            'height' => 'required|numeric',
            'diameter' => 'required|numeric',
            'payload' => 'required',
            'image' => 'mimetypes:image/png,image/jpeg'
        ];
    }
}
