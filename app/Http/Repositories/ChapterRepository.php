<?php

namespace App\Http\Repositories;

use App\Concretes\Repository;
use App\Models\Chapter;

class ChapterRepository extends Repository
{
    public function __construct(protected Chapter $model){}
}
