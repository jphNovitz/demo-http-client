<?php

namespace App\Service;

use App\Exception\UnauthorizedException;
use App\Model\TwitterGetterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function PHPUnit\Framework\throwException;


/**
 * Class TwitterGetter
 *
 * uses http-client component to get the last tweets and return it to the controller
 *
 * @author novitz Jean-Philiipe <novitz@gmail.com>
 * @package App\Service
 * @implement App\Model\TwitterGetterInterface
 */
class TwitterGetter implements TwitterGetterInterface
{

    private $client;
    private $bearer;
    private $screenName;
    private $count;

    public function __construct(HttpClientInterface $client, array $params)
    {
        $this->client = $client;
        $this->screenName = $params['screenName'];
        $this->count = $params['count'];
        $this->bearer = $params['bearer'];
    }

    public function getDatas()
    {

        try {
            $response = $this->client->request(
                'GET',
                'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $this->screenName . '&count=' . $this->count,
                ['headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->bearer
                ]]
            );

            if ($response->getStatusCode() === 401) throw  new UnauthorizedException();
            return $response->getContent();
        } catch (TransportExceptionInterface $exception) {

            throw  new \LogicException('Invalid Credentials');
//            return false;
        }
    }


}