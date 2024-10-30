<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\ReturnRefundPolicy;

class ReturnRefundPolicyRepository extends Repository
{
    public function __construct(protected ReturnRefundPolicy $model){}
}
