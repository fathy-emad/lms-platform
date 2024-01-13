<?php

namespace App\Facades;
use App\Interfaces\ApiResponseInterface;
use Illuminate\Support\Facades\Facade;


class ApiResponseFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ApiResponseInterface::class;
    }
}

