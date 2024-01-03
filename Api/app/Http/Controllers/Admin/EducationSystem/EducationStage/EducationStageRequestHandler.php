<?php

namespace App\Http\Controllers\Admin\EducationSystem\EducationStage;

use App\Concretes\RequestHandler;
use App\Traits\TranslationTrait;

class EducationStageRequestHandler extends RequestHandler
{
    use TranslationTrait;

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
