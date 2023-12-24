<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Country;

class CountryRepository extends Repository
{
    public function __construct(protected Country $model){}
}
