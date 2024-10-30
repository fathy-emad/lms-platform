<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\CancellationRefundPolicy;

class CancellationRefundPolicyRepository extends Repository
{
    public function __construct(protected CancellationRefundPolicy $model){}
}
