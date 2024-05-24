<?php

namespace App\Http\Repositories;

use App\Models\BankQuestion;
use App\Concretes\Repository;

class BankQuestionRepository extends Repository
{
    public function __construct(protected BankQuestion $model){}
}
