<?php

namespace App\Http\Controllers\SettingEducation\Chapter;

use App\Concretes\RequestHandler;
use App\Models\Chapter;

class ChapterRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->setPriority();
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

    public function setPriority(): void
    {
        $enumerationModel = Chapter::where('branch_id', $this->data["branch_id"])->orderBy('priority', 'desc')->first();

        if ($enumerationModel) $this->data["priority"] = $enumerationModel->priority + 1;
        else $this->data["priority"] = 1;
    }
}
