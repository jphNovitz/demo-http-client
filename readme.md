# Welcome to "http client demo", Symfony 5 version

## About
**[Http-client](https://github.com/symfony/http-client)** is a symfony component that fetch  HTTP resources synchronously or asynchronously. *This component can be used outside Symfony*.

I used http-client sometime ago to retrieve data from distant resource.  More recently I used it in a project to get
last twitter posts and show them in my site footer. Http-Client is easy to use,  I had the idea to try it in other project than Symfony.

## The Exercice

I have a Twitter account, I used the [Twitter API](https://developer.twitter.com/en/docs/twitter-api) to retrieve my last posts and show it in a simple page.

To connect your code to the Twitter API you need to get your Screen name and his Bearer Token to authentify yourself.  I used th count variable to specify the maximum (5) post to import.


## The basics

### Environnement file.
BEARER = *your bearer token*  
SCREEN_NAME = *your screen name*  
COUNT = *max twitter posts*

### Services and controllers

I used two services:
* A getter: his mission is just take the env variable and use http-client component to fetch the twitter content.
* A presenter: The twitter datas is very huge and i dont't want my template page to manage big object, just
  receive the needed data and display them.  The presenter get a big and complex array of objects and return an array of light objects.  
  The presenter simplify the template code.

The controller is simple: he calls the getter, use the presenter and pass it to the view.

Each time I used Interfaces for the contract, and the abstraction layer.

I made basic test using phpunit

## Languages

The language used was PHP,  three versions:

* *This version was made with **Symfony 5.2*** ;
* PHP Oriented object without framework ;
* Laravel 8.