<?php

namespace App\Http\Controllers\SettingEducation\EduSubject\Requests;

use App\Concretes\ValidateRequest;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {

        return [
            "id" => "required|exists:edu_subjects,id",
            "subject" => "required|array|min:1",
            "subject.ar" =>  "required|string",
            "subject.*" => "nullable|string",
        ];
    }
}
