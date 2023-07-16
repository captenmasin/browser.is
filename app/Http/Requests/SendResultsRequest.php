<?php

namespace App\Http\Requests;

use App\Enums\Tool;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class SendResultsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email.*' => ['required', 'email'],
            'uuid' => ['string', 'required'],
            'type' => ['string', 'required', new EnumValue(Tool::class)]
        ];
    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    protected function prepareForValidation(): void
    {
        $emails = explode(',', rtrim($this->email, ','));
        $i = 0;
        foreach ($emails as $email){
            $emails[$i] = trim($email, ' ');
            $i++;
        }
        $this->merge(['email' => $emails]);
    }
}
