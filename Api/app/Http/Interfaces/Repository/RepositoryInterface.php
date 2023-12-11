<?php

namespace App\Http\Interfaces;

interface RepositoryInterface
{
    public function getById($id);
    public function create($data);
    public function getAll();
    public function update($id, $data);
    public function delete($id);
}
