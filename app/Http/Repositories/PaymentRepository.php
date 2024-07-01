<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Payment;

class PaymentRepository extends Repository
{
    public function __construct(protected Payment $model){}
}
