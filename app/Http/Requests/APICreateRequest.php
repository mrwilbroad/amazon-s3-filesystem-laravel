<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class APICreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "projectname" => ['required',"regex:/^[A-Z]{1}[a-z]{1,18}[\-]{1}[a-z]{1,30}$/"]
        ];
    }

    public function messages()
    {
        return [
            "projectname.required" => "Project name is required",
            "projectname.regex" => "Project name: First character must be uppercase, followed by lowercase and symbol (-) followed by lowercase character eg. myproject-anothername, Don't exceed 50 Characters"
        ];
    }
}
