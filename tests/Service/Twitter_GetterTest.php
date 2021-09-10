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

    public function setUp(): void
    {
        parent::setUp();

        $this->endpoint = 'https://foo.com';
        $this->params = [
            "screenName" => 'screen_name',
            "count" => 1,
            "bearer" => "bearer"
        ];
    }

/*
 * What de symfony doc says about errors that can be raised.
  When the HTTP status code of the response is not in the 200-299 range (i.e. 3xx, 4xx or 5xx) your code is expected to handle it.
  If you don't do that, the getHeaders() and getContent() methods throw an appropriate exception:
  https://symfony.com/blog/new-in-symfony-4-3-httpclient-component
*/
    public function test_twitter_respond_with_a_401_error()
    {
        $expectedResponseData = ['id' => 12345];
        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);

        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 401,
            'response_headers' => ['Content-Type: application/json'],
        ]);
        $this->client = new MockHttpClient($mockResponse, 'https://example.com');

        $service = new TwitterGetter($this->client, $this->params);

        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage('The request is unauthorized, please check your credentials');

        $response = $service->getDatas();
    }
}