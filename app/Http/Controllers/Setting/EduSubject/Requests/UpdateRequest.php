<?php

namespace App\Http\Controllers\Setting\EduSubject\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {

        return [
            "id" => "required|exists:languages,id",
            "subject" => "required|array|min:1",
            "subject.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "subject.*" => "nullable|string",
        ];
    }
}
