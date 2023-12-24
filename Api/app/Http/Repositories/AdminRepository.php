<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Admin;

class AdminRepository extends Repository
{
    public function __construct(protected Admin $model){}
}
