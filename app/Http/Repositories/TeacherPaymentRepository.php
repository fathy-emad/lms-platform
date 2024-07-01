<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\TeacherPayment;

class TeacherPaymentRepository extends Repository
{
    public function __construct(protected TeacherPayment $model){}
}
