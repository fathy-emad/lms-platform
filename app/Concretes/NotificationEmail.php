<?php

namespace App\Concretes;

use ApiResponse;
use App\Mail\OTPMail;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\NotificationInterface;

class NotificationEmail implements NotificationInterface
{
    public function send($user, $data, $type): void
    {
        $template = $this->template($type);

        try {
            Mail::to($user->email)->send(new $template($user, $data));

        } catch (\Exception $e) {
            throw new HttpResponseException(ApiResponse::sendError(["Notification send error" => [$e->getMessage()]], 'Notification send error please try again later', null));

        }
    }

    public function template($type): string
    {
        return match ($type) {
            'otp' => OTPMail::class,
            default => 'Invalid Template',
        };
    }

}
