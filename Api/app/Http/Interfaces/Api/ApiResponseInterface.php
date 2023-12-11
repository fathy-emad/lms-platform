<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Response;

interface ApiResponseInterface
{
    public function set(): void;
    public function handle(int $status_code, array $message, mixed $data): array;
    public function send(int $status_code, array $message, mixed $data, array $headers = []): Response;
}
