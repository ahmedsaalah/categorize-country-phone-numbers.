<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User.
 *
 * @package namespace App\Customer;
 */
class Customer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $table = 'customer';

}