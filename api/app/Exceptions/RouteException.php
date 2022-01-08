<?php

namespace App\Exceptions;

class RouteException extends BaseException
{
    public function __construct($code) {
        parent::__construct($code);
    }
    

}
