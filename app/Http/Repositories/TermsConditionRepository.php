<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\TermsCondition;

class TermsConditionRepository extends Repository
{
    public function __construct(protected TermsCondition $model){}
}

