<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobRequest extends FormRequest
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
            "title" => "required|string|min:5|max:120",
            "description" => "required|string|min:10|max:255",
            "salary" => "required|numeric|min:4000|max:1000000",
            "location" => "required|string|max:80",
            "experience" => ["required", "string", Rule::in(\App\Models\Job::$experienceLevel)],
            "category" => ["required", "string", Rule::in(\App\Models\Job::$jobCategory)]
        ];
    }
}
