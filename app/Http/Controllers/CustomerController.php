<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\CustomerService;



class CustomerController extends Controller
{
    private $customerService;
    /**
     * Constructor
     * 
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService ) {
        $this->customerService = $customerService;
    }

    public function index(Request $request) {
        $countries = $this->customerService->getCustomers();
        return $this->getSuccessResponse($countries);
    }

}
