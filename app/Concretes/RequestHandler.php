<?php

namespace App\Concretes;

use ApiResponse;
use App\Enums\ActiveEnum;
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

    public function handleActiveEnum(): void
    {
        $this->data["ActiveEnum"] = isset($this->data["ActiveEnum"]) ? ActiveEnum::Active->value :  ActiveEnum::NotActive->value;
    }


    public function reorder($model)
    {
        foreach ($this->data["reorder"] as $arrange)
            $model->update($arrange["id"], ["priority" => $arrange["priority"]]);

        return ApiResponse::sendSuccess([], "records Reorder successfully", null);
    }
}
