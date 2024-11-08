<?php

namespace App\Interfaces;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentServiceEnum;
use App\Models\Student;

interface CheckoutInterface
{
    public function pay(array $data): mixed;
}
