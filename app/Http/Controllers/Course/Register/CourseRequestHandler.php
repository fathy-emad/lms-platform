<?php

namespace App\Http\Controllers\Course\Register;

use App\Concretes\RequestHandler;

class CourseRequestHandler extends RequestHandler
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
