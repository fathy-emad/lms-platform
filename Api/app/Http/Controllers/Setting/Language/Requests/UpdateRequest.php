<?php

namespace App\Http\Controllers\Setting\Language\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        //regex:/^[\x{0600}-\x{06FF}\s]+$/u", regex for ar string
        //"regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u", regex for en string
        return [
            "id" => "required|exists:languages",
            "locale" => "required|string|unique:languages,locale,".$this->id,
            "language" => "required|array|min:1",
            "language.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "language.*" => "nullable|string",
            "flag" => "nullable|file|mimes:svg,xml",
            "ActiveEnum" => "required|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
