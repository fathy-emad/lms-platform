<?php

namespace App\Interfaces;

interface NotificationInterface
{
    public function send($user, $data, $type): void;
}
