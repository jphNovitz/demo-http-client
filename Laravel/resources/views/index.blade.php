@extends('base')

@section('content')
    <article class="tweeter">
        @if ($tweets !== null)

            <h2 class="title">Derniers tweets
                <span class="link">
                    [<a href="https://twitter.com/jphNovitz" target="_blank">@jphNovitz </a>]
                </span>
            </h2>
            @foreach($tweets as $tweet)
                <div class="tweet">
                    <div class="content">
                        @if(isset($tweet['image']) && $tweet['image'] !== null)
                            <div class="caption">
                                <img src="{{ $tweet['image'] }}" alt="jphNovitz image tweeter"/> <br/>
                            </div>
                        @endif
                        <div class="text">
                            {{ $tweet['text']}}
                        </div>
                    </div>
                    @if(isset($tweet['hashtags']) && count($tweet['hashtags']) > 0)
                        <div class="hashtags">
                            @foreach($tweet['hashtags'] as $tag)
                                #{{ $tag }}
                            @endforeach
                        </div>
                    @endif
                    <div class="link">
                        <a href="{{ $tweet['link'] }}"
                           target="_blank">
                            Le {{ $tweet['date'] }}
                        </a>
                    </div>
                </div>
            @endforeach
        @else
        <p>Probleme de réseau, aucun tweet à afficher</p>
        @endif
    </article>

@endsection
