<?php

namespace App\Http\Controllers;

use App\Services\TwitterGetter;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function index(TwitterGetter $twitterGetter){
        dd($twitterGetter->getDatas());
    }
}
