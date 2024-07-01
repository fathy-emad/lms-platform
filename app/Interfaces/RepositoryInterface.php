<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    public function getById(int $id): Model;
    public function create(array $data): Model;
    public function getAll(): Collection;
    public function paginate(): LengthAwarePaginator;

    public function update(int $id, array $data): Model;
    public function delete(int $id): Model;
}
