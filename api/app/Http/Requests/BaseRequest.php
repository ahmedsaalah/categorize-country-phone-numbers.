<?php

/**
 * This is the parent of all requests
 * Extended by all requests to handle returning error messages when validations fail
 *
 * @author Ahmed Salah
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\GeneralService;
use App\Constants\Error;
use App\Exceptions\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ValidationException;

class BaseRequest extends FormRequest {

    /**
     * 
     * @param GeneralService $generalService
     * @param array $query
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param type $content
     */
    public function __construct( array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    /**
     * Authorization rules for the request
     * 
     * @return boolean
     */
    public function authorize() {
        throw new AuthorizationException(Error::UNAUTHORIZED_ACCESS);
    }

    protected function failedValidation(Validator $validator) {
        throw new ValidationException(Error::INVALID_INPUTS, $validator->errors()->messages());
    }
}
