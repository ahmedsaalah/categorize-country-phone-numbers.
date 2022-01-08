<?php

namespace App\Http\Controllers;
use App\Http\Requests\GetCustomersRequest;
use App\Services\CustomerService;
use App\Constants\Paginate;

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

    public function index(GetCustomersRequest $request) {
        $country =($request->country)?$request->country:null;
        $state =($request->state)?$request->state:null;
        $page =($request->page)?$request->page:Paginate::PAGE;
        $per_page =($request->per_page)?$request->per_page:Paginate::PER_PAGE;

        $countries = $this->customerService->getCustomers($country, $state, $page, $per_page);
        return $this->getSuccessResponse($countries);
    }

}