<?php

namespace App\Http\Controllers\Student\Cart;

use App\Concretes\RequestHandler;

class CartRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        return $this;
    }

    public function handleUpdate(): static
    {
        return $this;
    }
}
