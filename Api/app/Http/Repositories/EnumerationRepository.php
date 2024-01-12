<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Enumeration;

class EnumerationRepository extends Repository
{
    public function __construct(protected Enumeration $model){}
}
