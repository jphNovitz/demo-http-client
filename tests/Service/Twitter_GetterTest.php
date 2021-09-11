<?php

namespace App\Tests\Service;

use App\Exception\UnauthorizedException;
use App\Service\TwitterGetter;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\MockHttpClient;

class Twitter_GetterTest extends TestCase
{

    protected $client;
    protected $params;
    protected $endpoint;
    protected $error_codes;

    public function setUp(): void
    {
        parent::setUp();

        $this->endpoint = 'https://foo.com';
        $this->params = [
            "screenName" => 'screen_name',
            "count" => 1,
            "bearer" => "bearer"
        ];

//        $this->error_codes = [
//            ["code" => "401", "type"=> "App\Exception\UnauthorizedException", "message" => "The request is unauthorized, please check your credentials"],
//            ["code" => "400", "type"=> "App\Exception\UnauthorizedException", "message" => "Bad Request"],
//        ];

    }



    /*
     * What de symfony doc says about errors that can be raised.
      When the HTTP status code of the response is not in the 200-299 range (i.e. 3xx, 4xx or 5xx) your code is expected to handle it.
      If you don't do that, the getHeaders() and getContent() methods throw an appropriate exception:
      https://symfony.com/blog/new-in-symfony-4-3-httpclient-component
    */

    /**
     * @param $error
     * @throws UnauthorizedException
     * @throws \JsonException
     * @dataProvider errorDataProvider
     */
    public function test_twitter_respond_with_a_401_error($code, $type, $message)
    {

            $expectedResponseData = ['id' => 12345];
            $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);

            $mockResponse = new MockResponse($mockResponseJson, [
                'http_code' => $code,
                'response_headers' => ['Content-Type: application/json'],
            ]);
            $this->client = new MockHttpClient($mockResponse, 'https://example.com');

            $service = new TwitterGetter($this->client, $this->params);

            $this->expectException($type);
//            $this->expectException(UnauthorizedException::class);
            $this->expectExceptionMessage($message);

            $response = $service->getDatas();

    }

    public function errorDataProvider(){
        return [
            ["code" => "401", "type"=> "App\Exception\UnauthorizedException", "message" => "The request is unauthorized, please check your credentials"],
            ["code" => "400", "type"=> "App\Exception\BadRequestException", "message" => "Bad Request"],
            ["code" => "404", "type"=> "App\Exception\NotFoundException", "message" => "The Resource cannot be found"],
            ["code" => "403", "type"=> "App\Exception\ForbiddenException", "message" => "The request is forbidden"],
        ];
    }
}