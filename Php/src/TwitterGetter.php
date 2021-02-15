<?php

namespace App;

use App\Contract\TwitterGetterIntercace;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\RetryableHttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class TwitterGetter implements TwitterGetterIntercace
{
    private $client;
    private $bearer;
    private $count;
    private $screenName;

    public function __construct()
    {
        $this->client = new RetryableHttpClient(HttpClient::create());

        $raw = file_get_contents('env.json');
        $env = json_decode($raw, true);
        $this->bearer = $env["BEARER"];
        $this->count = $env["COUNT"];
        $this->screenName = $env["SCREEN_NAME"];
    }

    public function getDatas()
    {
        try {
            return $this->client->request(
                'GET',
                'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $this->screenName . '&count=' . $this->count,
                ['headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->bearer
                ]]
            )->getContent();
        } catch (TransportExceptionInterface $exception){
            return false;
        }
    }

}