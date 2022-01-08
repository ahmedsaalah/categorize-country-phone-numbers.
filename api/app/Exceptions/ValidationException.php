<?php

/**
 * This exception is thrown in case of account errors
 *
 * @author Ahmed salah
 */

namespace App\Exceptions;
use App\Exceptions\BaseException;
class ValidationException extends BaseException {

    public $errors;

    public function __construct($code, $errors) {
        parent::__construct($code);
        $this->errors = $errors;
    }

}
