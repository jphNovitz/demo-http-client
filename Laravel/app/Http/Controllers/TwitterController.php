<?php

namespace App\Http\Controllers;

use App\Services\TwitterGetter;
use App\Services\TwitterPresenter;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function index(TwitterGetter $twitterGetter,TwitterPresenter  $presenter){
        //dd($presenter->prepareDatas($twitterGetter->getDatas()));
        return view('index', [
            'tweets'=> $presenter->prepareDatas($twitterGetter->getDatas())
            ]);
    }
}
