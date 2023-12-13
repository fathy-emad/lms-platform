<?php

namespace App\Http\Interfaces;

interface ServiceInterface
{
    public function set($request): array;
    public function get(): array;
    public function handle(): void;
}
