<?php

namespace Tests\Unit;

use App\Services\GeneralService;
use PHPUnit\Framework\TestCase;

class GeneralTest extends TestCase
{
    /**
     * A basic test filter by key function .
     *
     * @return void
     */
    public function test_filter_by_key()
    {
        $input = [
            [
                "code" => "+256",
                "country" => "Uganda",
                "phone_num" => "775069443",
                "state" => 1
            ],
            [
                "code" => "+256",
                "country" => "Egypt",
                "phone_num" => "704244430",
                "state" => 1
            ],
            [
                "code" => "+256",
                "country" => "Uganda",
                "phone_num" => "714660221",
                "state" => 1
            ]
        ];
        $output= GeneralService::filterByKey("country", "Egypt", collect($input));
        $mock = [      [
            "code" => "+256",
            "country" => "Egypt",
            "phone_num" => "704244430",
            "state" => 1
        ]];
        $this->assertEqualsCanonicalizing($output->toArray(), $mock);
    }
}
