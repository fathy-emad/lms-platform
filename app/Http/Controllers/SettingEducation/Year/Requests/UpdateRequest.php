<?php

namespace App\Http\Controllers\SettingEducation\Year\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\SystemConstantsEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Validator;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:years,id",
            "stage_id" => "required|integer|exists:stages,id",
            "year" => "required|array|min:1",
            "year.ar" =>  "required|string",
            "year.*" => "nullable|string",
            "image.key" => [
                "nullable",
                "integer",
                Rule::exists("countries", "flag->key")->where(function ($query){
                    return $query->where("id", $this->id);
                })
            ],
            "image.file" => "nullable|image",
            "image.title" => "nullable|string",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->sometimes('image.file', 'required|image', function ($input) {
            return empty($input->image['key']);
        });
    }
}
