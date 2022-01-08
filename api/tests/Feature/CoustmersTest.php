<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoustmersTest extends TestCase
{
    /**
     * test check that server running
     *
     * @return void
     */
    public function test_check_server()
    {

        $response = $this->json('GET', '/api/customers');

        $response->assertStatus(200);
    }

    /**
     * test get coustmers response output
     *
     * @return void
     */
    public function test_basic_customers()
    {
        $jayParsedAry = [
            "current_page" => 1,
            "data" => [
                [
                    "code" => "+212",
                    "country" => "Morocoo",
                    "phone_num" => "6007989253",
                    "state" => 0
                ],
                [
                    "code" => "+212",
                    "country" => "Morocoo",
                    "phone_num" => "698054317",
                    "state" => 1
                ],
                [
                    "code" => "+212",
                    "country" => "Morocoo",
                    "phone_num" => "6546545369",
                    "state" => 0
                ],
                [
                    "code" => "+212",
                    "country" => "Morocoo",
                    "phone_num" => "6617344445",
                    "state" => 0
                ],
                [
                    "code" => "+212",
                    "country" => "Morocoo",
                    "phone_num" => "691933626",
                    "state" => 1
                ],
                [
                    "code" => "+212",
                    "country" => "Morocoo",
                    "phone_num" => "633963130",
                    "state" => 1
                ],
                [
                    "code" => "+212",
                    "country" => "Morocoo",
                    "phone_num" => "654642448",
                    "state" => 1
                ],
                [
                    "code" => "+258",
                    "country" => "Mozambique",
                    "phone_num" => "847651504",
                    "state" => 1
                ],
                [
                    "code" => "+258",
                    "country" => "Mozambique",
                    "phone_num" => "846565883",
                    "state" => 1
                ],
                [
                    "code" => "+258",
                    "country" => "Mozambique",
                    "phone_num" => "849181828",
                    "state" => 1
                ]
            ],
            "first_page_url" => "http://localhost/api/customers?page=1",
            "from" => 1,
            "last_page" => 5,
            "last_page_url" => "http://localhost/api/customers?page=5",
            "links" => [
                [
                    "url" => null,
                    "label" => "&laquo; Previous",
                    "active" => false
                ],
                [
                    "url" => "http://localhost/api/customers?page=1",
                    "label" => "1",
                    "active" => true
                ],
                [
                    "url" => "http://localhost/api/customers?page=2",
                    "label" => "2",
                    "active" => false
                ],
                [
                    "url" => "http://localhost/api/customers?page=3",
                    "label" => "3",
                    "active" => false
                ],
                [
                    "url" => "http://localhost/api/customers?page=4",
                    "label" => "4",
                    "active" => false
                ],
                [
                    "url" => "http://localhost/api/customers?page=5",
                    "label" => "5",
                    "active" => false
                ],
                [
                    "url" => "http://localhost/api/customers?page=2",
                    "label" => "Next &raquo;",
                    "active" => false
                ]
            ],
            "next_page_url" => "http://localhost/api/customers?page=2",
            "path" => "http://localhost/api/customers",
            "per_page" => 10,
            "prev_page_url" => null,
            "to" => 10,
            "total" => 41
        ];
        $response = $this->json('GET', '/api/customers');
        $response
            ->assertStatus(200)
            ->assertJson($jayParsedAry);
    }

    /**
     * test filter coustmers response with country output
     *
     * @return void
     */
    public function test_customers_filter_by_country()
    {

        $jayParsedAry = [
          "current_page" => 1, 
          "data" => [
                [
                   "code" => "+256", 
                   "country" => "Uganda", 
                   "phone_num" => "775069443", 
                   "state" => 1 
                ], 
                [
                      "code" => "+256", 
                      "country" => "Uganda", 
                      "phone_num" => "7503O6263", 
                      "state" => 0 
                   ], 
                [
                         "code" => "+256", 
                         "country" => "Uganda", 
                         "phone_num" => "704244430", 
                         "state" => 1 
                      ], 
                [
                            "code" => "+256", 
                            "country" => "Uganda", 
                            "phone_num" => "7734127498", 
                            "state" => 0 
                         ], 
                [
                               "code" => "+256", 
                               "country" => "Uganda", 
                               "phone_num" => "7771031454", 
                               "state" => 0 
                            ], 
                [
                                  "code" => "+256", 
                                  "country" => "Uganda", 
                                  "phone_num" => "3142345678", 
                                  "state" => 0 
                               ], 
                [
                                     "code" => "+256", 
                                     "country" => "Uganda", 
                                     "phone_num" => "714660221", 
                                     "state" => 1 
                                  ] 
             ], 
          "first_page_url" => "http://localhost/api/customers?page=1", 
          "from" => 1, 
          "last_page" => 1, 
          "last_page_url" => "http://localhost/api/customers?page=1", 
          "links" => [
                                        [
                                           "url" => null, 
                                           "label" => "&laquo; Previous", 
                                           "active" => false 
                                        ], 
                                        [
                                              "url" => "http://localhost/api/customers?page=1", 
                                              "label" => "1", 
                                              "active" => true 
                                           ], 
                                        [
                                                 "url" => null, 
                                                 "label" => "Next &raquo;", 
                                                 "active" => false 
                                              ] 
                                     ], 
          "next_page_url" => null, 
          "path" => "http://localhost/api/customers", 
          "per_page" => 10, 
          "prev_page_url" => null, 
          "to" => 7, 
          "total" => 7 
       ]; 
        $response = $this->json('GET', 'api/customers?country=Uganda');
        $response
            ->assertStatus(200)
            ->assertJson($jayParsedAry);
    }

    /**
     * test filter coustmers response with country output
     *
     * @return void
     */
    public function test_customers_filter_by_state()
    {
        $jayParsedAry = [
          "current_page" => 1, 
          "data" => [
                [
                   "code" => "+212", 
                   "country" => "Morocoo", 
                   "phone_num" => "6007989253", 
                   "state" => 0 
                ], 
                [
                      "code" => "+212", 
                      "country" => "Morocoo", 
                      "phone_num" => "6546545369", 
                      "state" => 0 
                   ], 
                [
                         "code" => "+212", 
                         "country" => "Morocoo", 
                         "phone_num" => "6617344445", 
                         "state" => 0 
                      ], 
                [
                            "code" => "+258", 
                            "country" => "Mozambique", 
                            "phone_num" => "84330678235", 
                            "state" => 0 
                         ], 
                [
                               "code" => "+258", 
                               "country" => "Mozambique", 
                               "phone_num" => "042423566", 
                               "state" => 0 
                            ], 
                [
                                  "code" => "+256", 
                                  "country" => "Uganda", 
                                  "phone_num" => "7503O6263", 
                                  "state" => 0 
                               ], 
                [
                                     "code" => "+256", 
                                     "country" => "Uganda", 
                                     "phone_num" => "7734127498", 
                                     "state" => 0 
                                  ], 
                [
                                        "code" => "+256", 
                                        "country" => "Uganda", 
                                        "phone_num" => "7771031454", 
                                        "state" => 0 
                                     ], 
                [
                                           "code" => "+256", 
                                           "country" => "Uganda", 
                                           "phone_num" => "3142345678", 
                                           "state" => 0 
                                        ], 
                [
                                              "code" => "+251", 
                                              "country" => "Ethiopia", 
                                              "phone_num" => "9773199405", 
                                              "state" => 0 
                                           ] 
             ], 
          "first_page_url" => "http://localhost/api/customers?page=1", 
          "from" => 1, 
          "last_page" => 2, 
          "last_page_url" => "http://localhost/api/customers?page=2", 
          "links" => [
                                                 [
                                                    "url" => null, 
                                                    "label" => "&laquo; Previous", 
                                                    "active" => false 
                                                 ], 
                                                 [
                                                       "url" => "http://localhost/api/customers?page=1", 
                                                       "label" => "1", 
                                                       "active" => true 
                                                    ], 
                                                 [
                                                          "url" => "http://localhost/api/customers?page=2", 
                                                          "label" => "2", 
                                                          "active" => false 
                                                       ], 
                                                 [
                                                             "url" => "http://localhost/api/customers?page=2", 
                                                             "label" => "Next &raquo;", 
                                                             "active" => false 
                                                          ] 
                                              ], 
          "next_page_url" => "http://localhost/api/customers?page=2", 
          "path" => "http://localhost/api/customers", 
          "per_page" => 10, 
          "prev_page_url" => null, 
          "to" => 10, 
          "total" => 14 
       ]; 
        
        
        $response = $this->json('GET', 'api/customers?state=0');
        $response
            ->assertStatus(200)
            ->assertJson($jayParsedAry);
    }

    /**
     * test filter coustmers response with country and state output
     *
     * @return void
     */
    public function test_customers_filter_by_country_state()
    {
        $jayParsedAry = [
          "current_page" => 1, 
          "data" => [
                [
                   "code" => "+256", 
                   "country" => "Uganda", 
                   "phone_num" => "775069443", 
                   "state" => 1 
                ], 
                [
                      "code" => "+256", 
                      "country" => "Uganda", 
                      "phone_num" => "704244430", 
                      "state" => 1 
                   ], 
                [
                         "code" => "+256", 
                         "country" => "Uganda", 
                         "phone_num" => "714660221", 
                         "state" => 1 
                      ] 
             ], 
          "first_page_url" => "http://localhost/api/customers?page=1", 
          "from" => 1, 
          "last_page" => 1, 
          "last_page_url" => "http://localhost/api/customers?page=1", 
          "links" => [
                            [
                               "url" => null, 
                               "label" => "&laquo; Previous", 
                               "active" => false 
                            ], 
                            [
                                  "url" => "http://localhost/api/customers?page=1", 
                                  "label" => "1", 
                                  "active" => true 
                               ], 
                            [
                                     "url" => null, 
                                     "label" => "Next &raquo;", 
                                     "active" => false 
                                  ] 
                         ], 
          "next_page_url" => null, 
          "path" => "http://localhost/api/customers", 
          "per_page" => 10, 
          "prev_page_url" => null, 
          "to" => 3, 
          "total" => 3 
       ];  
        $response = $this->json('GET', 'api/customers?state=1&country=Uganda');
        $response
            ->assertStatus(200)
            ->assertJson($jayParsedAry);
    }

    /**
     * test  coustmers response pagination
     *
     * @return void
     */
    public function test_customers_pagination()
    {
        $response = $this->json('GET', 'api/customers?page=2');
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                "current_page"=> 2,
            ]);
    }
}
