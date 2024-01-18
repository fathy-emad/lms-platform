<?php

namespace App\Http\Controllers\Admin\System\Branch;

use App\Concretes\RequestHandler;
use App\Models\Branch;

class BranchRequestHandler extends RequestHandler
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
        $enumerationModel = Branch::where('curriculum_id', $this->data["curriculum_id"])->orderBy('priority', 'desc')->first();

        if ($enumerationModel) $this->data["priority"] = $enumerationModel->priority + 1;
        else $this->data["priority"] = 1;
    }
}
