<?php

namespace App\Concretes;

use Exception;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    public function create(array $data): Model|string
    {
        try {
            return $this->model->create($data);
        } catch (Exception $e) {
            // Handle exceptions related to model creation
            return $e;
        }
    }

    public function getById(int $id): Model|string
    {
        try {
            return $this->model->find($id);
        } catch (Exception $e) {
            // Handle other exceptions
            // Log the exception or handle it as required
            return $e;
        }
    }

    public function getAll(): Collection|string
    {
        try {
            return $this->model->orderBy("id", "desc")->get();
        } catch (Exception $e) {
            // Handle exceptions
            // Return an empty collection or handle as required
            return $e;
        }
    }

    public function getAllWhere(array $attributes): Collection|string
    {
        try {
            return $this->model->where($attributes)->get();
        } catch (Exception $e) {
            // Handle exceptions
            // Return an empty collection or handle as required
            return new Collection();
        }
    }

    public function update(int $id, array $data): Model|string
    {
        try {
            $model = $this->model->find($id);
            $model->update($data);
            return $model;
        } catch (Exception $e) {
            // Handle other exceptions
            return $e;
        }
    }

    public function delete(int $id): Model|string
    {
        try {
            $model = $this->model->find($id);
            $model->delete();
            return $model;
        } catch (Exception $e) {
            // Handle other exceptions
            return $e;
        }
    }
}
