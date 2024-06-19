<?php

namespace App\Http\Controllers\Student\Cart\Requests;

use App\Concretes\ValidateRequest;
use App\Models\Cart;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "student_id" => "required|integer|exists:students,id|in:". auth("student")->id(),
            "course_id" => [
                "required",
                "integer",
                "exists:courses,id",
                function($attribute, $value, $fail) {
                    if (Cart::where(['student_id' => $this->student_id, 'course_id' => $value])->exists()) {
                        $fail('This course is already in the cart.');
                    }
                },
            ]
        ];
    }
}
