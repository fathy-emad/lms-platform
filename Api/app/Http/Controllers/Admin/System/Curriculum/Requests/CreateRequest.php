<?php

namespace App\Http\Controllers\Admin\System\Curriculum\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "subject_id" => "required|integer|exists:subjects,id",
            "curriculum" => "required|string|min:2",
            "TermsEnumTable" => "required|array",
            "TermsEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    $query->where('key', 'education_terms');
                }),
            "TypesEnumTable" => "required|array",
            "TypesEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    $query->where('key', 'education_types');
                }),
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
