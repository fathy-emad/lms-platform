<?php

namespace App\Http\Controllers\Admin\System\Curriculum\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        $request = $this;
        return [
            "id" => "required|integer|exists:curricula,id",
            "subject_id" => "required|integer|exists:subjects,id",
            "curriculum" => "required|array|min:1",
            "curriculum.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "curriculum.*" => "nullable|string",
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
