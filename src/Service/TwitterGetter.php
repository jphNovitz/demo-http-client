<?php

namespace App\Service;

use App\Exception\BadRequestException;
use App\Exception\ForbiddenException;
use App\Exception\GeneralRequestException;
use App\Exception\NotFoundException;
use App\Exception\UnauthorizedException;
use App\Exception\WrongDataTypeException;
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

            $this->validateRequestCode($response->getStatusCode());


            json_decode($response->getContent());
            if (json_last_error() === JSON_ERROR_NONE) return $response->getContent();
            throw  new WrongDataTypeException();
        } catch (TransportExceptionInterface $exception) {

            throw  new \LogicException('Invalid Credentials');
//            return false;
        }
    }

    /**
     * @param $code
     * @return bool
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws GeneralRequestException
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function validateRequestCode($code)
    {
        switch (true):
            case $code === 400:
                throw  new BadRequestException();
            case $code === 401:
                throw  new UnauthorizedException();
            case $code === 403:
                throw  new ForbiddenException();
            case $code === 404:
                throw  new NotFoundException();
            case ($code > 400) && ($code < 600) :
                throw  new GeneralRequestException();
            default:
                return true;
        endswitch;
    }


}