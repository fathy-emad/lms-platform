<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Language;

class LanguageRepository extends Repository
{
    public function __construct(protected Language $model){}
}
