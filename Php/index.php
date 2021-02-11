<?php

require __DIR__ . '/vendor/autoload.php';

use App\TwitterGetter;
use App\TwitterPresenter;

$twitterGetter = new TwitterGetter();
$presenter = new TwitterPresenter();

$tweets = $presenter->prepareDatas($twitterGetter->getDatas());
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <meta charset="UTF-8">
    <title>jphNovittz laste Five tweets</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>
<body>
<div class="container">
    <article class="tweeter">
        <?php if (!empty($tweets)) { ?>
            <h2 class="title">Derniers tweets
                <span class="link">
                    [<a href="https://twitter.com/jphNovitz" target="_blank">@jphNovitz </a>]
                </span>
            </h2>
            <?php foreach ($tweets as $tweet) { ?>
                <div class="tweet">
                    <div class="content">
                        <?php if ($tweet['image'] != null) : ?>
                
                            <div class="caption">
                                <img src="<?php echo $tweet['image'] ?>" alt="jphNovitz image tweeter"/> <br/>
                            </div>
                        <?php endif; ?>
                        <div class="text">
                            <?php echo $tweet['text'] ?>
                        </div>
                    </div>
                    <?php if (isset($tweet['hashtags']) && count($tweet['hashtags']) > 0) { ?>
                        <div class="hashtags">
                            <?php foreach ($tweet['hashtags'] as $tag):
                                echo "#" . $tag . " ";
                            endforeach ?>
                        </div>
                    <?php } ?>
                    <div class="link">
                        <a href="<?php echo $tweet['link'] ?>"
                           target="_blank">
                            Le <?php echo $tweet['date']; ?>
                        </a>
                    </div>
                </div>

            <?php }
        } else {
            ?>

            <p>Probleme de réseau, aucun tweet à afficher</p>
        <?php }; ?>
    </article>


</div>
</body>
</html>

