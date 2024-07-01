<?php

namespace App\Concretes;

use Exception;
use ApiResponse;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class Repository implements RepositoryInterface
{
    protected $query;

    public function create(array $data): Model
    {
        try {
            return $this->model->create($data);
        } catch (Exception $e) {
            // Handle exceptions related to model creation
            throw new HttpResponseException(
                ApiResponse::sendError(["some thing went wrong" => [$e->getMessage()]], 'Creation Record Error', null)
            );
        }
    }

    public function getById(int $id): Model
    {

        try {
            $model = $this->model->find($id);

            if ($model) {
                return $model;
            }

            throw new HttpResponseException(
                ApiResponse::sendError(["something went wrong" => ["Record Not Found"]], 'Read Record Error', null)
            );

        } catch (ModelNotFoundException|Exception $e){

            throw new HttpResponseException(
                ApiResponse::sendError(["some thing went wrong" => ["Record Not Found"]], 'Read Record Error', null)
            );
        }
    }

    public function getAll(): Collection
    {
        try {
            $model = $this->query->get();
            $this->query = $this->model->newQuery();
            return $model;

        } catch (Exception $e) {
            throw new HttpResponseException(
                ApiResponse::sendError(["some thing went wrong" => [$e->getMessage()]], 'Read Records Error', null)
            );
        }
    }

    public function paginate(): LengthAwarePaginator
    {
        try {
            $model = $this->query->paginate(request()->per_page);
            $model->appends(Arr::except(request()->all(), "page"));
            $this->query = $this->model->newQuery();
            return $model;
        } catch (Exception $e) {
            // Handle exceptions
            // Return an empty collection or handle as required
            throw new HttpResponseException(
                ApiResponse::sendError(["some thing went wrong" => [$e->getMessage()]], 'Creation Records Pagination Error', null)
            );
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
                $conditions[trim($key)] = trim($value == "null" ? null : $value);
            }
            $this->query = $this->query->where($conditions);
        }

        return $this;
    }

    public function orWhere($attributes): static
    {

        if ($attributes){
            $attributes = explode(",", $attributes);
            $this->query = $this->query->orWhere(function ($query) use($attributes) {
                foreach ($attributes as $attribute) {
                    list($key, $value) = explode(':', $attribute);
                    $query->where($key, $value == "null" ? null : $value);
                }
            });
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

    public function update(int $id, array $data): Model
    {
        try {
            $model = $this->model->find($id);
            $model->update($data);
            return $model;
        } catch (Exception $e) {
            // Handle other exceptions
            throw new HttpResponseException(
                ApiResponse::sendError(["some thing went wrong" => [$e->getMessage()]], 'Update Record Error', null)
            );
        }
    }

    public function delete(int $id): Model
    {
        try {
            $model = $this->model->find($id);
            $model->delete();
            return $model;
        } catch (Exception $e) {
            // Handle other exceptions
            throw new HttpResponseException(
                ApiResponse::sendError(["some thing went wrong" => [$e->getMessage()]], 'Delete Record Error', null)
            );
        }
    }
}
