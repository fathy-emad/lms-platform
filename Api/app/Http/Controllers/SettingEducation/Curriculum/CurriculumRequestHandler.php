<?php

namespace App\Http\Controllers\SettingEducation\Curriculum;

use App\Concretes\RequestHandler;
use App\Models\Curriculum;

class CurriculumRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->setPriority();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate(): static
    {
        $this->bindUpdatedBy();
        return $this;
    }


    public function setPriority(): void
    {
        $enumerationModel = Curriculum::where('subject_id', $this->data["subject_id"])->orderBy('priority', 'desc')->first();

        if ($enumerationModel) $this->data["priority"] = $enumerationModel->priority + 1;
        else $this->data["priority"] = 1;
    }
}
