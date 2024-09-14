<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\PrivacyPolicy;

class PrivacyPolicyRepository extends Repository
{
    public function __construct(protected PrivacyPolicy $model){}
}

