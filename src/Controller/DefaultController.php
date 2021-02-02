<?php

namespace App\Controller;

use App\Model\TwitterGetterInterface;
use App\Model\TwitterPresenterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController{

    private $content;

    public function __construct(TwitterGetterInterface $twitterGetter)
    {

        $this->content = $twitterGetter->getDatas();

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