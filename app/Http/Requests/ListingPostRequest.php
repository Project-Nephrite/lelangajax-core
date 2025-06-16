<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingPostRequest extends FormRequest
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
            "name"          =>  "string|min:3|max:64",
            "description"   =>  "string|min:32",
            "value_base"    =>  "numeric|gt:5000",
            "status"        =>  "string",
            "category_id"   =>  "string|exists:categories,id",
            "schema_id"     =>  "required|string|exists:auction_schemes,id",
            "images"        =>  "array",
            "images.*"      =>  "file"
        ];
    }
}
