<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Cart;

class CartRepository extends Repository
{
    public function __construct(protected Cart $model){}
}
