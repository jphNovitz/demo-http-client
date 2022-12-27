<?php

namespace App\Controller;

use App\Model\TwitterGetterInterface;
use App\Model\TwitterPresenterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly TwitterGetterInterface $twitterGetter,
        private string                          $content = ''
    )
    {
        $this->content = $this->twitterGetter->getDatas();
    }

    #[Route("/", name: "homepage")]
    public function index(TwitterPresenterInterface $presenter): Response
    {
        return $this->render('index.html.twig', [
            'tweets' => $presenter->prepareDatas($this->content)
        ]);
    }

}