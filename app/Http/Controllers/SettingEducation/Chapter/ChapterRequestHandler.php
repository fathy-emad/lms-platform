<?php

namespace App\Http\Controllers\SettingEducation\Chapter;

use Translation;
use App\Models\Chapter;
use App\Concretes\RequestHandler;

class ChapterRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->setPriority();
        $this->bindCreatedBy();
        $this->handleActiveEnum();
        $this->translateChapter(null);
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->handleActiveEnum();
        $this->translateChapter($model->chapter);
        return $this;
    }

    public function setPriority(): void
    {
        $enumerationModel = Chapter::where('curriculum_id', $this->data["curriculum_id"])->orderBy('priority', 'desc')->first();

        if ($enumerationModel) $this->data["priority"] = $enumerationModel->priority + 1;
        else $this->data["priority"] = 1;
    }

    public function translateChapter(?int $id): void
    {
        $this->data["chapter"] = Translation::translate('chapter', 'chapters', $this->data["chapter"], $id);
    }
}
