<?php

namespace App\Http\Controllers\Setting\Country\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:countries",
            "symbol" => "required|string|unique:countries,symbol,".$this->id,
            "country" => "required|array|min:1",
            "country.ar" =>  "required|string|regex:/^[\x{0600}-\x{06FF}\s\W]+$/u",
            "country.*" => "nullable|string",
            "phone_prefix" => "required|string",
            "timezone" => "required|string",
            "currency" => "required|array|min:1",
            "currency.ar" =>  "required|string|regex:/^[\x{0600}-\x{06FF}\s\W]+$/u",
            "currency.*" => "nullable|string",
            "currency_symbol" => "required|string",
            "flag.key" => [
                "nullable",
                "integer",
                Rule::exists("countries", "flag->key")->where(function ($query){
                    return $query->where("id", $this->id);
                })
            ],
            "flag.file" => "nullable|file|mimes:svg,xml",
            "flag.title" => "nullable|string",
            "ActiveEnum" => "sometimes|in:".implode(",", ActiveEnum::values()),
        ];
    }


    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->sometimes('flag.file', 'required|file|mimes:svg,xml', function ($input) {
            return empty($input->flag['key']);
        });
    }
}
