<?php

namespace App\Service;

use App\Exception\BadRequestException;
use App\Exception\ForbiddenException;
use App\Exception\GeneralRequestException;
use App\Exception\NotFoundException;
use App\Exception\UnauthorizedException;
use App\Exception\WrongDataTypeException;
use App\Model\TwitterGetterInterface;
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
class TwitterGetter implements TwitterGetterInterface
{

    public function __construct(
        private HttpClientInterface $client,
        private string              $screenName = '',
        private string              $bearer = '',
        private int                 $count = 0,
    )
    {
        $this->bearer = $_ENV['BEARER'];
        $this->screenName = $_ENV['SCREEN_NAME'];
        $this->count = $_ENV['COUNT'];
    }

    /**
     * @return string
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws GeneralRequestException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws WrongDataTypeException
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     */
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
    public function validateRequestCode($code): bool
    {
        switch ($code):
            case 200:
                return true;
            case 400:
                throw  new BadRequestException();
            case 401:
                throw  new UnauthorizedException();
            case 403:
                throw  new ForbiddenException();
            case 404:
                throw  new NotFoundException();
            default:
                throw  new GeneralRequestException();
        endswitch;
    }
}