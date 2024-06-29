<?php

namespace App\Http\Repositories;

use App\Models\Invoice;
use App\Concretes\Repository;

class InvoiceRepository extends Repository
{
    public function __construct(protected Invoice $model){}
}
