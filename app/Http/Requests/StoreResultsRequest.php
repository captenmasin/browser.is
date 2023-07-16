<?php

namespace App\Http\Requests;

use App\Enums\Tool;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class StoreResultsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data' => ['json'],
            'type' => [new EnumValue(Tool::class)]
        ];
    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
