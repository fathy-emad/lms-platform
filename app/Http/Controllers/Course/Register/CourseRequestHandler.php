<?php

namespace App\Http\Controllers\Course\Register;

use App\Concretes\RequestHandler;

class CourseRequestHandler extends RequestHandler
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
