<?php

namespace App\Http\Controllers\SettingEducation\Subject;

use App\Concretes\RequestHandler;

class SubjectRequestHandler extends RequestHandler
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
