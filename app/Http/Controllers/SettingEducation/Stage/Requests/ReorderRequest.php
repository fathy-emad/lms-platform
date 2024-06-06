<?php

namespace App\Http\Controllers\SettingEducation\Stage\Requests;

use App\Concretes\ValidateRequest;

class ReorderRequest extends ValidateRequest
{

    public function rules(): array
    {
        return [
            "reorder.*.id" => "required|integer|exists:stages,id",
            "reorder.*.priority" => "required|integer"
        ];
    }
}
