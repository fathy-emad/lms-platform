<?php

namespace App\Http\Controllers\SettingEducation\EduSubject\Requests;

use App\Concretes\ValidateRequest;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {

        return [
            "id" => "required|exists:languages,id",
            "subject" => "required|array|min:1",
            "subject.ar" =>  "required|string|regex:/^[\x{0600}-\x{06FF}\s\W]+$/u",
            "subject.*" => "nullable|string",
        ];
    }
}
