<?php

namespace App\Facades;

use App\Services\TranslationService;
use Illuminate\Support\Facades\Facade;

class TranslationFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TranslationService::class;
    }
}
