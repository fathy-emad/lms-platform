<?php

namespace App\Http\Controllers\Admin\Administrator\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class DeleteRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:admins",
        ];
    }
}
