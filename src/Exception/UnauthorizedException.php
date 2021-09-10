<?php
namespace App\Exception;


class UnauthorizedException extends \Exception
{

    protected $message = "The request is unauthorized, please check your credentials";

}