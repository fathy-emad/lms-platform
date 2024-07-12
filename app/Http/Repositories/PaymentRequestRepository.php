<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\PaymentRequest;

class PaymentRequestRepository extends Repository
{
    public function __construct(protected PaymentRequest $model){}
}
