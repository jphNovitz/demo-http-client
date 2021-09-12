<?php
namespace App\Exception;


class WrongDataTypeException extends \Exception
{

    protected $message = "The content is not a valid json";

}