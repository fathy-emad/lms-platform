<?php

namespace App\Http\Controllers\Admin\System\Chapter;

use App\Concretes\RequestHandler;
use App\Models\Branch;
use App\Models\Chapter;

class ChapterRequestHandler extends RequestHandler
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
        $enumerationModel = Chapter::where('branch_id', $this->data["branch_id"])->orderBy('priority', 'desc')->first();

        if ($enumerationModel) $this->data["priority"] = $enumerationModel->priority + 1;
        else $this->data["priority"] = 1;
    }
}
