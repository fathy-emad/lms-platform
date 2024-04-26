<?php

namespace App\Http\Controllers\Setting\Language\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        //regex:/^[\x{0600}-\x{06FF}\s]+$/u", regex for ar string
        //"regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u", regex for en string
        return [
            "id" => "required|exists:languages,id",
            "locale" => "required|string|unique:languages,locale,".$this->id,
            "language" => "required|array|min:1",
            "language.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "language.*" => "nullable|string",
            "flag" => "nullable|array",
            "flag.key" => [
                "nullable",
                "integer",
                Rule::exists("languages", "flag->key")->where(function ($query){
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
