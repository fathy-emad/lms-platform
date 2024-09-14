<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\FAQ;

class FAQRepository extends Repository
{
    public function __construct(protected FAQ $model){}
}
