<?php

namespace App\Controller;

use App\Model\TwitterGetterInterface;
use App\Model\TwitterPresenterInterface;
use App\Service\TwitterGetter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface ;

class DefaultController extends AbstractController
{

    private $content;

    public function __construct()
    {
        $params = [
            'bearer' => $_ENV['BEARER'],
            'screenName' => $_ENV['SCREEN_NAME'],
            'count' => $_ENV['COUNT'],
        ];
//dd($params);
        $twitter = new TwitterGetter($params);
        $this->content = $twitter->getDatas();

    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(TwitterPresenterInterface $presenter)
    {
        return $this->render('index.html.twig', [
            'tweets' => $presenter->prepareDatas($this->content)
        ]);
    }

}