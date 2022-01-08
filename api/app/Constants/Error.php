<?php

namespace App\Constants;

use Illuminate\Http\Response;

/**
 * This class contains error codes returned by the api with their respective messages 
 * and http response codes
 *
 * @author Ahmed salah
 */
class Error {

    const LOW_SEVERITY = 1;
    const MEDIUM_SEVERITY = 2;
    const HIGH_SEVERITY = 3;

    
    const SEVERITY_MSG = array(
        self::LOW_SEVERITY => "Low",
        self::MEDIUM_SEVERITY => "Medium",
        self::HIGH_SEVERITY => "High",
    );
    
    const INVALID_INPUTS = 1;
    const UNAUTHORIZED_ACCESS = 2;
    const UNKNOWN_ERROR = 3;
    const METHOD_NOT_ALLOWED = 4;
    const ROUTE_NOT_FOUND = 5;


    const MSG = array(
        self::UNAUTHORIZED_ACCESS => 'Unauthorized access',
        self::INVALID_INPUTS => 'Invalid inputs',
        self::UNKNOWN_ERROR => 'Unknown error',
        self::METHOD_NOT_ALLOWED  => 'Method not allowed',
        self::ROUTE_NOT_FOUND => "Route not found",
    );

    const HTTPCODE = array(
        self::UNAUTHORIZED_ACCESS => Response::HTTP_UNAUTHORIZED,
        self::INVALID_INPUTS => Response::HTTP_UNPROCESSABLE_ENTITY,        
        self::UNKNOWN_ERROR => Response::HTTP_INTERNAL_SERVER_ERROR,
        self::METHOD_NOT_ALLOWED  => Response::HTTP_METHOD_NOT_ALLOWED,
        self::ROUTE_NOT_FOUND => Response::HTTP_NOT_FOUND,
    );

    const SEVERITY = array(
        self::UNAUTHORIZED_ACCESS => self::MEDIUM_SEVERITY,
        self::INVALID_INPUTS => self::LOW_SEVERITY,
        self::UNKNOWN_ERROR => self::HIGH_SEVERITY,
        self::METHOD_NOT_ALLOWED  =>  self::LOW_SEVERITY,
        self::ROUTE_NOT_FOUND => self::LOW_SEVERITY,
    );

}