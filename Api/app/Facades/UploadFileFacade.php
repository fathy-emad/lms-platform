<?php

namespace App\Facades;

use App\Services\UploadFileService;
use Illuminate\Support\Facades\Facade;

class UploadFileFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UploadFileService::class;
    }
}
