<?php
namespace App\Exception;


class ForbiddenException extends \Exception
{

    protected $message = "The request is forbidden";

}