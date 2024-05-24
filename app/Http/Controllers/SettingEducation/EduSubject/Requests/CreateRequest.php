<?php

namespace App\Http\Controllers\SettingEducation\EduSubject\Requests;

use App\Concretes\ValidateRequest;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "subject" => "required|string|min:2",
        ];
    }
}
