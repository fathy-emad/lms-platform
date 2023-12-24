<?php

namespace App\Interfaces;

interface RequestHandlerInterface
{
    public function set(array $data): static;
    public function get(): array;

    public function bindCreatedBy(): void;
    public function bindUpdatedBy(): void;
}
