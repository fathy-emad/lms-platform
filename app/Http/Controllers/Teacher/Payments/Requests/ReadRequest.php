<?php

namespace App\Http\Controllers\Teacher\Payments\Requests;

use App\Concretes\ValidateRequest;
use App\Models\Teacher;

class ReadRequest extends ValidateRequest
{
    public function rules(): array
    {

        return [
            'where' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {

                    $id = explode(":", $value)[1];

                    if (!Teacher::find($id))
                        $fail("This teacher not found");

                    if (auth("teacher")->id() != $id)
                        $fail("Sorry you are not the auth teacher");
                }
            ]
        ];

    }
}
