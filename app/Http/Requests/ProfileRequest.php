<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            "name" => "required|string|max:80",
            "title" => "required|string|max:125",

            "type" => ["required", Rule::in(\App\Models\Profile::$profileType)],
            "about" => "string|max:500",

            "location" => "string|max:80",
            "category_1" => [Rule::in(\App\Models\Job::$jobCategory)],
            "category_2" => [Rule::in(\App\Models\Job::$jobCategory)],
            "category_3" => [Rule::in(\App\Models\Job::$jobCategory)],
        ];
    }
}
