<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;

class TwitterGetter
{

    private $client;
    private $bearer;
    private $screenName;
    private $count;

    public function __construct(Http $client)
    {
        $this->client = $client;
        $this->screenName = env('SCREEN_NAME');
        $this->count = env('COUNT');
        $this->bearer = env('BEARER');

    }

    public function getDatas()
    {
        $response = $this->client::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->bearer
        ])->get(
            'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $this->screenName . '&count=' . $this->count,

            );
        if ($response->failed()) $response->throw();
            //return false;

        return $response->body();
    }

}
