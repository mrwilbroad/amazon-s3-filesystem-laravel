<?php

namespace App\Http\Requests\Youtube;

use Illuminate\Foundation\Http\FormRequest;

class YoutubeRequest extends FormRequest
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
            "youtube_Content"=> ['required',"max:100"]
        ];
    }


    public function messages()
    {
        return [
            "youtube_Content.required" => "Type content to search",
            "youtube_Content.max" => "Too long search"
        ];

        
    }
}
