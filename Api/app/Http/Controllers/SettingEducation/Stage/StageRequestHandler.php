<?php

namespace App\Http\Controllers\SettingEducation\Stage;

use App\Concretes\RequestHandler;

class StageRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate(): static
    {
        $this->bindUpdatedBy();
        return $this;
    }
}
