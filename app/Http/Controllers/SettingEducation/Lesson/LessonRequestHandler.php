<?php

namespace App\Http\Controllers\SettingEducation\Lesson;

use App\Concretes\RequestHandler;
use App\Models\Chapter;

class LessonRequestHandler extends RequestHandler
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
        $enumerationModel = Chapter::where('chapter_id', $this->data["chapter_id"])->orderBy('priority', 'desc')->first();

        if ($enumerationModel) $this->data["priority"] = $enumerationModel->priority + 1;
        else $this->data["priority"] = 1;
    }
}
