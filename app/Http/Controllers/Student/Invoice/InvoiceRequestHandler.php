<?php

namespace App\Http\Controllers\Student\Invoice;

use App\Concretes\RequestHandler;

class InvoiceRequestHandler extends RequestHandler
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
