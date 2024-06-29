<?php

namespace App\Http\Controllers\Student\Invoice\Requests;

use App\Concretes\ValidateRequest;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "student_id" => "required|integer|exists:students,id|in:". auth("student")->id(),
            "courses" => "required|array",
            "courses.*" => "required|integer|exists:courses,id",
            "paymentMethod" => "nullable|string",
            "paymentIntegration" => "nullable|string",
            "paymentData" => "nullable|string",
            "totalCost" => "required|numeric",
            "itemCount" => "required|integer",
        ];
    }
}
