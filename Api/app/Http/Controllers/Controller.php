<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ApiResponseInterface;
use App\Models\Locale;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;



    public function __construct(protected ApiResponseInterface $apiResponse){

    }

    public function create_model($data)
    {
        $data = Locale::create($data);
        $this->apiResponse->send();
    }

    public function read_model()
    {

    }

    public function update_model()
    {

    }

    public function delete_model()
    {

    }
}
