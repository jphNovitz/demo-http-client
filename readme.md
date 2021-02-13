#Welcome to "http client demo"
______________________________

##Languages
___________

The language used was PHP, three versions:

* PHP Oriented object without framework ;
* Symfony 5.2 ;
* Laravel 8.

##About
______
**[Http-client](https://github.com/symfony/http-client)** is a symfony component that fetch  HTTP resources synchronously or asynchronously. *This component can be used outside Symfony*.
    

I used http-client for several month to retrieve data from distant resource.  More recently i used it in a project to get 
last twitter posts and show them in my site footer. Http-Client is easy to use and i had the idea to try it in other project than Symfony.  

I did three this exercice three times: Symfony, Laravel, PHP.  

##The Exercice
______________

I have a twitter account, I used the [Twitter API](https://developer.twitter.com/en/docs/twitter-api) to retrieve my last posts and show it in a simple page.

To connect your code to the Twitter API you need to get your Screen name and his Bearer Token to authentify yourself.  I used th count variable to specify the maximum (5) post to import.  


##The basics
____________

###Environnement file.
BEARER = *your bearer token*  
SCREEN_NAME = *your screen name*  
COUNT = *max twitter posts*  

###Services and controllers  

I used two services:
* A getter: his mission is just take the env variable and use http-client component to fetch the twitter content. 
* A presenter: The twitter datas is very huge and i dont't want my template page to manage big object, just 
receive the needed data and display them.  The presenter get a big and complex array of objects and return an array of light objects.  
  The presenter simplify the template code.  
    
The controller is simple: he calls the getter, use the presenter and pass it to the view.


