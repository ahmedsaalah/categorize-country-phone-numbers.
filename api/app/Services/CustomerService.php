<?php


namespace App\Services;

use App\Constants\SearchKey;
use App\Constants\Paginate;
use App\Models\Customer;


class CustomerService
{

    public function getCustomers($country = null, $state = null, $page = Paginate::PAGE, $perPage = Paginate::PER_PAGE)
    {
        $customers = collect(Customer::all('phone')->toArray());
        if (isset($country)) {
            $customers = GeneralService::filterByKey(SearchKey::COUNTRY, $country, $customers)->values();
        }
        if (isset($state)) {
            $customers =  GeneralService::filterByKey(SearchKey::STATE, $state, $customers)->values();
        }
        return  GeneralService::paginate($customers, $perPage, $page);
    }
}