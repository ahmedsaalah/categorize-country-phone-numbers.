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
    protected $hidden = ['phone'];
    protected $appends = ['code', 'country', 'phone_num', 'state'];
    private $code_to_regex_hash = array(
        "237" => '/237 ?[2368]\d{7,8}$/',
        "251" => '/251 ?[1-59]\d{8}$/',
        "212" => '/212 ?[5-9]\d{8}$/',
        "258" => '/258 ?[28]\d{7,8}$/',
        "256" => '/256 ?\d{9}$/'
    );
    private $code_to_country_hash = array(
        "237" => "Cameroon",
        "251" => "Ethiopia",
        "212" => "Morocoo",
        "258" => "Mozambique",
        "256" => "Uganda"
    );

    public function setCode($code)
    {
        $this->attributes['code'] = $code;
    }

    public function getCode()
    {
        return $this->attributes['code'];
    }

    public function getCodeAttribute()
    {

        $code = explode(" ", $this->phone)[0];
        $this->setCode(str_replace(array("(", ")"), "", $code));
        return "+" . $this->getCode();
    }

    public function setCountry($country)
    {
        $this->attributes['country'] = $country;
    }

    public function getCountry()
    {
        return $this->attributes['country'];
    }

    public function getCountryAttribute()
    {
        $code = $this->getCode();
        if (array_key_exists($code, $this->code_to_country_hash)) {
            $this->setCountry($this->code_to_country_hash[$code]);
        }
        return $this->getCountry();
    }

    public function setState($state)
    {
        $this->attributes['state'] = $state;
    }

    public function getState()
    {
        return $this->attributes['state'];
    }

    public function getStateAttribute()
    {
        if (!array_key_exists($this->getCode(), $this->code_to_regex_hash)) {
            return false;
        }
        $pattern = $this->code_to_regex_hash[$this->getCode()];
        return preg_match($pattern, $this->getCode() . $this->getPhoneNumber());
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->attributes['phone_num'] = $phoneNumber;
    }

    public function getPhoneNumber()
    {

        return $this->attributes['phone_num'];
    }

    public function getPhoneNumAttribute($value)
    {
        $this->setPhoneNumber(explode(" ", $this->phone)[1]);
        return $this->getPhoneNumber();
    }
}
