<?php

namespace App\Http\Controllers\SettingEducation\Year\Requests;

use App\Concretes\ValidateRequest;

class ReorderRequest extends ValidateRequest
{

    public function rules(): array
    {
        return [
            "reorder.*.id" => "required|integer|exists:years,id",
            "reorder.*.priority" => "required|integer"
        ];
    }
}
