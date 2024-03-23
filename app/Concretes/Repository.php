<?php

namespace App\Concretes;

use Exception;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class Repository implements RepositoryInterface
{
    protected $query;

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
            $model = $this->model->find($id);
            return $model ?: "Record Not Found";

        } catch (ModelNotFoundException|Exception $e){
            return $e->getMessage();

        }
    }

    public function getAll(): Collection|string
    {
        try {
            $model = $this->query->get();
            $this->query = $this->model->newQuery();
            return $model;

        } catch (Exception $e) {
            return $e;
        }
    }

    public function paginate(): LengthAwarePaginator|string
    {
        try {
            $model = $this->query->paginate(request()->per_page);
            $model->appends(Arr::except(request()->all(), "page"));
            $this->query = $this->model->newQuery();
            return $model;
        } catch (Exception $e) {
            // Handle exceptions
            // Return an empty collection or handle as required
            return $e;
        }
    }

    public function Where($attributes): static
    {
        $this->query = $this->model->newQuery();

        if ($attributes){
            $attributes = explode(",", $attributes);
            $conditions = [];

            foreach ($attributes as $attribute) {
                list($key, $value) = explode(':', $attribute);
                $conditions[trim($key)] = trim($value);
            }
            $this->query = $this->query->where($conditions);
        }

        return $this;
    }

    public function orderBy($attributes): static
    {

        if ($attributes){
            $attributes = explode(",", $attributes);
            $conditions = [];

            foreach ($attributes as $attribute) {
                list($key, $value) = explode(':', $attribute);
                $conditions[trim($key)] = trim($value);
                $this->query = $this->query->orderBy(trim($key), trim($value));
            }
        }

        return $this;
    }

    public function skip($attribute): static
    {
        if ($attribute)$this->query = $this->query->skip(trim($attribute));
        return $this;
    }

    public function take($attribute): static
    {
        if ($attribute)$this->query = $this->query->take(trim($attribute));
        return $this;
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
