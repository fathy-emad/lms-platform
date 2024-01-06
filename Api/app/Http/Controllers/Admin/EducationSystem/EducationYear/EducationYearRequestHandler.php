<?php

namespace App\Http\Controllers\Admin\EducationSystem\EducationYear;

use App\Concretes\RequestHandler;

class EducationYearRequestHandler extends RequestHandler
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
