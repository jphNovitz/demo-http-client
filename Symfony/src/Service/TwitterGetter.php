<?php

namespace App\Service;

use App\Model\TwitterGetterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


/**
 * Class TwitterGetter
 *
 * uses http-client component to get the last tweets and return it to the controller
 *
 * @author novitz Jean-Philiipe <novitz@gmail.com>
 * @package App\Service
 * @implement App\Model\TwitterGetterInterface
 */
class TwitterGetter implements TwitterGetterInterface {

    private $client;
    private $bearer;
    private $screenName;
    private $count;

    public function __construct(HttpClientInterface $client, ContainerInterface $container){
        $this->client = $client;
        $this->screenName = $container->getParameter('screen_name');
        $this->count = $container->getParameter('count');
        $this->bearer = $container->getParameter('bearer');

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