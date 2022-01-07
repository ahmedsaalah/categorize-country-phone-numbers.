<?php

namespace App\Exceptions;

class CustomerException extends BaseException
{
    public function __construct($code) {
        parent::__construct($code);
    }
    

}
