<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\AdminRepository;
use App\Interfaces\ApiResponseInterface;

class AuthController extends Controller
{
    public function __construct(
        ApiResponseInterface $apiResponse,
        AdminRepository $repository,
    ){
        $this->apiResponse = $apiResponse;
        $this->repository = $repository;
    }
}
