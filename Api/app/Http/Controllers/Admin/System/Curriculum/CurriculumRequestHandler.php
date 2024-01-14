<?php

namespace App\Http\Controllers\Admin\System\Curriculum;

use App\Concretes\RequestHandler;

class CurriculumRequestHandler extends RequestHandler
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
