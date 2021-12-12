<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarningStoreRequest extends FormRequest
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
            'asunto'=>'required',
            'description'=>'required',
            'ubicacion'=>'required',
            'image'=>'nullable|image|max:3072',
            'latitud'=>'required',
            'longitud'=>'required',
            'sub_categoria'=>'required|in:'.auth()->user()->instance->warning_sub_categories->pluck('id')->implode(','),
        ];
    }
}
