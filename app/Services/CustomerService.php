<?php


namespace App\Services;

use App\Constants\MethodParameter;
use App\Exceptions\CustomerException;
use App\Constants\Error;
use App\Constants\SearchKey;
use App\Constants\Paginate;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;


class CustomerService
{


    public function __construct()
    {
    }

    public function getCustomers($filterByRoleId=0, $withDeleted=0)
    {
        $users = DB::select('select id from customer');
        return  Customer::select('*')->paginate(Paginate::PER_PAGE);
    }
}