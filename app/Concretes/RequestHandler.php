<?php

namespace App\Concretes;

use App\Interfaces\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{
    protected ?array $data;

    public function set(?array $data): static
    {
        $this->data = $data;
        return $this;
    }

    public function get(): array
    {
        return $this->data;
    }

    public function bindCreatedBy(): void
    {
        $this->data["created_by"] = auth('admin')->user()->id ?? null;
    }

    public function bindUpdatedBy(): void
    {
        $this->data["updated_by"] = auth('admin')->user()->id ?? null;
    }
}
