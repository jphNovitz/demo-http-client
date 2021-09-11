<?php
namespace App\Exception;


class NotFoundException extends \Exception
{

    protected $message = "The Resource cannot be found";

}