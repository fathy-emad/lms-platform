<?php

namespace App\Http\Controllers\Teacher\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\GenderEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "NamePrefixEnumTable" => [
                "required", "integer",
                Rule::exists('enumerations', 'id')->where(function ($query){
                    return $query->where('key', 'name_prefixes');
                })
            ],
            "name" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "phone" => "required|digits:10|unique:teachers",
            "email" => "required|email|unique:teachers",
            "password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
            "GenderEnum" => ["required", "string", new Enum(GenderEnum::class)],
            "image" => "nullable|image",
            "contract" => "nullable|file|mimes:pdf",
            "country_id" => "required|exists:countries,id",
            "SubjectsEnumTable" => "required|array",
            "SubjectsEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'education_subjects');
                }),
        ];
    }
}
