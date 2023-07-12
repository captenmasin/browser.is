<?php

namespace App\Http\Requests;

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
            'type' => ['in:browser,device,location']
        ];
    }

    /**
     * @throws \HttpResponseException
     */
    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
