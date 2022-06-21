<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAstronomicalObjectRequest extends FormRequest
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
            //
            'object_id' => 'required',
            'description' => 'required',
            'image_path' => 'required|mimetypes:image/png,image/jpeg',
            'file_path' => 'required|file|mimetypes:application/octet-stream'
        ];
    }
}
