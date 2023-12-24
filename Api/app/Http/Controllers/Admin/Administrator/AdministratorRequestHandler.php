<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Concretes\RequestHandler;

class AdministratorRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        return $this;
    }
}
