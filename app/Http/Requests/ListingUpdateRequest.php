<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingUpdateRequest extends FormRequest
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
            "id"            => "string|exists:listings,id",
            "name"          =>  "string|min:3|max:32",
            "description"   =>  "string|min:32",
            "category_id"   =>  "string|exists:categories,id",
        ];
    }
}
