<?php

namespace App\Http\Controllers\Employee\Permission;

use App\Concretes\RequestHandler;

class PermissionRequestHandler extends RequestHandler
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
