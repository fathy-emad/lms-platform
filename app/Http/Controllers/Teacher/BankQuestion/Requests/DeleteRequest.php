<?php

namespace App\Http\Controllers\Teacher\BankQuestion\Requests;

use App\Concretes\ValidateRequest;

class DeleteRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:bank_questions,id',
        ];
    }
}
