<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostinganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'img' => 'required|image|file|mimes:png,jpg,jpeg,webp|max:2024',
            'group' => 'required|url',
            'status' => 'required',
            'publish_date' => 'required'
        ];
    }
}
