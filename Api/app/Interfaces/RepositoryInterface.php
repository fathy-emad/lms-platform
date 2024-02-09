<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    public function getById(int $id): Model|string;
    public function create(array $data): Model|string;
    public function getAll(): Collection|string;
    public function paginate(): LengthAwarePaginator|string;

    public function update(int $id, array $data): Model|string;
    public function delete(int $id): Model|string;
}
