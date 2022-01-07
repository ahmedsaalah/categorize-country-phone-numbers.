<?php

/**
 * This exception is inherited by all exceptions
 *
 * @author Ahmed salah
 */

namespace App\Exceptions;

class BaseException extends \Exception {

    public function __construct($code, $dataArr = array()) {
        $this->httpCode = \App\Constants\Error::HTTPCODE[$code];
        $this->severity = \App\Constants\Error::SEVERITY[$code];

        $this->dataArr = $dataArr;
        parent::__construct(\App\Constants\Error::MSG[$code], $code);
    }

    private $httpCode;
    private $dataArr;
    private $severity;

    public function getHttpCode() {
        return $this->httpCode;
    }

    public function getSeverity() {
        return $this->severity;
    }

    public function getDataArr() {
        return is_null($this->dataArr) ? array() : $this->dataArr;
    }

}
