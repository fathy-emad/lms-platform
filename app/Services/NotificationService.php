<?php

namespace App\Services;

use ApiResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class NotificationService
{
    public function __construct(protected array $channels = []){}

    public function via(array $channels): static
    {
        $this->channels = $channels;
        return $this;
    }

    public function send($user, $data, $type): void
    {
        try {
            foreach ($this->channels as $channel)
            {
                $channel->send($user, $data, $type);
            }

        } catch (\Exception $e) {
            throw new HttpResponseException(ApiResponse::sendError(["Notification send error" => [$e->getMessage()]], 'Notification send error please try again later', null));
        }
    }
}
