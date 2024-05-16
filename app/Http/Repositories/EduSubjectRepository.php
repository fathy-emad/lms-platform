<?php

namespace App\Http\Repositories;

use App\Models\EduSubject;
use App\Concretes\Repository;

class EduSubjectRepository extends Repository
{
    public function __construct(protected EduSubject $model){}
}

