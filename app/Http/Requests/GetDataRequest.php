<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ip' => ['nullable', 'ip'],
            'uuid' => ['uuid', 'nullable']
        ];
    }
}
