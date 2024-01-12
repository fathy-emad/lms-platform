<?php

namespace App\Http\Controllers\Admin\System\Year;

use App\Concretes\RequestHandler;

class YearRequestHandler extends RequestHandler
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
