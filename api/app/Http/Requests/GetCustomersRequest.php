<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class GetCustomersRequest extends BaseRequest
{
    public function __construct() {
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country' => 'in:Cameroon,Ethiopia,Morocco,Mozambique,Uganda',
            'state'  => 'bool',
            'page' =>'integer',
            'per_page' => 'integer',

        ];
    }

    /**
     * Validation messages for the request
     * 
     * @return array
     */
    public function messages() {
        return [
            'country.in'=>'country should be in Cameroon,Ethiopia,Morocco,Mozambique,Uganda',
        ];
    }
}
