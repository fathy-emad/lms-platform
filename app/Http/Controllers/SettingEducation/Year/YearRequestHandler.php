<?php

namespace App\Http\Controllers\SettingEducation\Year;

use App\Concretes\RequestHandler;

class YearRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->bindCreatedBy();
        $this->handleActiveEnum();
        return $this;
    }

    public function handleUpdate(): static
    {
        $this->bindUpdatedBy();
        $this->handleActiveEnum();
        return $this;
    }
}
