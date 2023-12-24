<?php

namespace App\Concretes;

use App\Interfaces\ApiResponseInterface;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            app(ApiResponseInterface::class)
                ->sendError($validator->errors()->toArray(), 'validation error', null)
        );
    }
}
