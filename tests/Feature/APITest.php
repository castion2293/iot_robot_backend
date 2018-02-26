<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APITest extends TestCase
{
    protected $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ2YmNkNWJjMzVlNWM0YmQwMGRjY2JhMTgwZGMwM2M4ZGM3MWRmNGRkZjMxY2UwZjkyNzNhNTg0NjczYjVjYTc3MTA5NzkwMjNhMGQwZTg0In0.eyJhdWQiOiIxIiwianRpIjoiZDZiY2Q1YmMzNWU1YzRiZDAwZGNjYmExODBkYzAzYzhkYzcxZGY0ZGRmMzFjZTBmOTI3M2E1ODQ2NzNiNWNhNzcxMDk3OTAyM2EwZDBlODQiLCJpYXQiOjE1MTk2MjMwMTQsIm5iZiI6MTUxOTYyMzAxNCwiZXhwIjoxNTUxMTU5MDE0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.bPfWnWKmdrxAiX9C6xa_4k-5bUAv6hNR2kVwMoE0Ywoy9OE6mrNyYFHwL4Cz-M6YaXBmNpYq7XuJmL0FIgfxrkFQbH1svPfuDazelRtvFYGCS_7a7M_ig-59wgAFY0nr1i7MGZvI1WIrvNyKBoqOLfPSFfeD4gj6qfC14zUG0E5sguZ66I37PIF7GLxDzlJeTQ07G7IfCcd_d127NTeLVRi_TvLVerkCSS47svnHktzQ3O4Z1yIVLf38IHusQPu4W5M6-HFajC5F7qfTCGfc9hqMvMPzRBBRxoKm48rd0XNCbJP4i3t6xUSaJRN5tBwsReOLT4iI-cgilyYWjkTTgNz3v4D6YTa5o0GAJDxXELN6E7m8EGuFY_ehep0j9d1FURMrCmAiDqEI2jdzL5TB9W2VKpfRVnXlS5Y8uWj7Dv63QQtn3cRxfRdLRro045aMsZmPBaYQI5X-db3jrwDnbk8pYwFfaMcP-VFmdJUVfPm0AL8ELZmEqJmIpSa8RO7BPqRZIVI0GBNnsLBgojW-VhXEQpGo3ppU85gDPuU0LEY2tjEj1yv2jLifbUXyMUI2NMHdTgNwvsZT03YNNbgIw-SwNwOK7M2m3orfCm5iXffOtvpiCEk_0VshFYr1Q_EKCXFoEFSLuf_uSc6eXphOO1Kza7MgO7_k35FK3eCcRZE';
    protected $token_name = 'Ervin Douglas2018-02-26 05:30:14';

    public function setUp()
    {
        parent::setUp();

//        $response = $this->post('/api/login', ['email' => 'warren27@example.com', 'password' => 'secret']);
//        $this->token = 'Bearer ' . $response->original['token'];
//        $this->token_name = $response->original['token_name'];
//
//        $response->assertStatus(200);
    }

    /** @test */
    public function get_total_status_index_api()
    {
        $response = $this->get('api/total_status', ['Authorization' => $this->token, 'Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    /** @test */
    public function get_total_status_show_api()
    {
        $response = $this->get('api/total_status/88273', ['Authorization' => $this->token, 'Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    /** @test */
    public function get_alarm_index_api()
    {
        $response = $this->get('api/alarm?product_id=88273', ['Authorization' => $this->token, 'Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    /** @test */
    public function get_alarm_show_api()
    {
        $response = $this->get('api/alarm/c63c5460-04be-11e8-b5f1-2dec8ba65f5f?code=008-014', ['Authorization' => $this->token, 'Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    /** @test */
    public function get_status_index_api()
    {
        $response = $this->get('api/status', ['Authorization' => $this->token, 'Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    /** @test */
    public function get_status_show_api()
    {
        $response = $this->get('api/status/88273', ['Authorization' => $this->token, 'Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    /** @test */
    public function get_coordinate_show_api()
    {
        $response = $this->get('api/coordinate/88273', ['Authorization' => $this->token, 'Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    /** @test */
    public function get_product_index_api()
    {
        $response = $this->get('api/product', ['Authorization' => $this->token, 'Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    /** @test */
//    public function logout()
//    {
//        $response = $this->post('api/logout', ['Authorization' => $this->token, 'Accept' => 'application/json', 'token_name' => $this->token_name]);
//
//        $response->assertStatus(200);
//    }
}
