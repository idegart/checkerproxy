<?php

namespace App\Http\Requests\API\V1\Report;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'proxies' => [
                'required',
                'array',
            ],
            'proxies.*' => [
                'required',
                'string',
                'regex:/\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b:\d{2,5}/'
            ],
        ];
    }

    public function getProxies(): array
    {
        return $this->input('proxies');
    }

    public function messages(): array
    {
        return [
            'regex' => 'Not a valid proxy'
        ];
    }
}
