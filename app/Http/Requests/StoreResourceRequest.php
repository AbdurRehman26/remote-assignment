<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'type' => [
                'required',
                'string',
                Rule::in('html_snippet', 'pdf', 'link')
            ],
            'description' => [
                Rule::requiredIf($this->type === 'html_snippet'),
            ],
            'snippet' => [
                Rule::requiredIf($this->type === 'html_snippet'),
            ],
            'link' => [
                Rule::requiredIf($this->type === 'link'),
            ],
            'new_tab' => [
                Rule::requiredIf($this->type === 'link'),
            ],
        ];
    }
}
