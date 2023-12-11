<?php

namespace App\Http\Concretes;

use App\Http\Interfaces\ApiResponseInterface;

class ApiResponse implements ApiResponseInterface
{

    public function set(): void
    {

    }

    public function handle(): array
    {
        $return = [];
        $return["status_code"] = $status_code ?: 404;
        $return["message"] = $message ?: null;
        $return["data"] = $data ?: null;
        return $return;
    }

    public function send(): \Illuminate\Http\Response
    {
        $return = $this->handle($status_code, $message, $data);
        return response($return)->withHeaders($headers);
    }
}
