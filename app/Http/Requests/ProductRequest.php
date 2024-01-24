<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'store_id' => 'nullable|exists:stores,id',
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name,' . $this->id,
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price', //greater than price
            'options' => 'nullable|json',
            'rating' => 'numeric|min:0|max:5',
            'featured' => 'boolean',
            'status' => 'required|in:active,archived,draft',
        ];
    }
}
