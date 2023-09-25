<?php

namespace App\Services;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class HadaraSms
{
    protected $baseUrl = '';

    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
    }
    public function send($to, $message): void
    {
        Http::baseUrl($this->baseUrl)->get('sendmessage',[
            'apikey' => $this->key,
            'to' => $to,
            'msg' => $message
        ]);
    }
}
