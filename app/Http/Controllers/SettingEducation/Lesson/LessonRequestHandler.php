<?php

namespace App\Http\Controllers\SettingEducation\Lesson;

use Translation;
use App\Models\Lesson;
use App\Concretes\RequestHandler;

class LessonRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->setPriority();
        $this->bindCreatedBy();
        $this->handleActiveEnum();
        $this->translateLesson(null);
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->handleActiveEnum();
        $this->translateLesson($model->lesson);
        return $this;
    }

    public function setPriority(): void
    {
        $enumerationModel = Lesson::where('id', $this->data["chapter_id"])->orderBy('priority', 'desc')->first();

        if ($enumerationModel) $this->data["priority"] = $enumerationModel->priority + 1;
        else $this->data["priority"] = 1;
    }

    public function translateLesson(?int $id): void
    {
        $this->data["lesson"] = Translation::translate('lesson', 'lessons', $this->data["lesson"], $id);
    }
}
