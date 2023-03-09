<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataUploadRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'filename' => ['required', 'min:5', 'max: 100'],
            'data_color' => ['required', 'unique:data_uploads'],
            'database_name' => ['required'],
            'file_to_upload' => ['required'],
        ];
    }
}
