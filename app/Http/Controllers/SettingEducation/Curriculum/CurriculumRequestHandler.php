<?php

namespace App\Http\Controllers\SettingEducation\Curriculum;

use Translation;
use App\Concretes\RequestHandler;
use App\Models\Curriculum;

class CurriculumRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->setPriority();
        $this->bindCreatedBy();
        $this->handleActiveEnum();
        $this->translateCurriculum(null);
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->handleActiveEnum();
        $this->translateCurriculum($model->curriculum);
        return $this;
    }

    public function setPriority(): void
    {
        $enumerationModel = Curriculum::where('subject_id', $this->data["subject_id"])->orderBy('priority', 'desc')->first();

        if ($enumerationModel) $this->data["priority"] = $enumerationModel->priority + 1;
        else $this->data["priority"] = 1;
    }

    public function translateCurriculum(?int $id): void
    {
        $this->data["curriculum"] = Translation::translate('curriculum', 'curricula', $this->data["curriculum"], $id);
    }
}
