<?php

/**
 * This exception is thrown in case of admin errors
 *
 * @author Ahmed salah
 */

namespace App\Exceptions;

class GeneralException extends BaseException
{
    public function __construct($code) {
        parent::__construct($code);
    }
}
