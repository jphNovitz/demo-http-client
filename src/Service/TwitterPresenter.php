<?php

namespace App\Service;


use App\Model\TwitterPresenterInterface;
use function PHPUnit\Framework\throwException;


/**
 * Class TwitterPresenter
 *
 * receive raw content and return an array with just the needed informations
 *
 * @author novitz Jean-Philiipe <novitz@gmail.com>
 * @package App\Service
 * @implement App\Model\TwitterPresenterInterface
 */
class TwitterPresenter implements TwitterPresenterInterface
{

    public function prepareDatas($content)
    {
        if (!$content) throw new \Exception('Content variable cannot be null');

        $tweets = [];
        $raw_tweets = json_decode($content);
        //dd($raw_tweets);
        foreach ($raw_tweets as $raw_tweet) {
            $tweet['date'] = date('d/m/y', strtotime($raw_tweet->created_at));
            $new_text = '';
            //dump($raw_tweet->text);die;
            $exploded = preg_split("/[\s,]+/", $raw_tweet->text, -1, PREG_SPLIT_DELIM_CAPTURE);
            foreach ($exploded as $piece) {
                if (substr($piece, 0, 1) !== "#") {
                    if (substr($piece, 0, 8) !== "https://") {
                        $new_text .= $piece . ' ';
                    } else {
                        $tweet['link'] = $piece;
                    }
                }
            }
            //echo $new_text; die;
            $tweet['text'] = htmlspecialchars_decode($new_text);
            $tweet['hashtags'] = [];
            foreach ($raw_tweet->entities->hashtags as $tag):
                array_push($tweet['hashtags'], $tag->text);
            endforeach;

            if (isset($raw_tweet->entities->media)) {
                $tweet['image'] = $raw_tweet->entities->media[0]->media_url;
            }  else $tweet['image'] = null;

            array_push($tweets, $tweet);

        }

        return $tweets;
    }


}