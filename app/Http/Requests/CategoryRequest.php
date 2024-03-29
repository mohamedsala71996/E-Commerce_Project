<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // if ($this->route('id')) {
        //    return Gate::allows('categories.edit');
            
        // }
        // return  Gate::allows('categories.create');
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
            'name' => 'required|string|max:255|unique:categories,name,' . $this->id,
            'status' => 'required|in:active,archived',
            'image'  => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id' => 'nullable|int|exists:categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.unique' => 'The name has already been taken or you need to force delete it from trashes.',
        ];
    }
}
