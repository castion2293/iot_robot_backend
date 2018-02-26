<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APITest extends TestCase
{
    protected $token;

    public function setUp()
    {
        parent::setUp();

        $response = $this->post('/api/login', ['email' => 'warren27@example.com', 'password' => 'secret']);
        $this->token = 'Bearer ' . $response->original['token'];

        $response->assertStatus(200);
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
    public function logout()
    {
        $response = $this->get('api/logout', ['Authorization' => $this->token, 'Accept' => 'application/json']);

        $response->assertStatus(200);
    }
}
