<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APITest extends TestCase
{
    protected $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY2OTZjMTk2YTZkMDcxYzE0Y2RkZTE1NjQ4MDMyNjY2OGRiNjRmMmQ1MGRmZTk1OTdjNzJlYWM4ODNkNjIyMTEzNjkzZGI3MzdmNDM2OTVmIn0.eyJhdWQiOiIxIiwianRpIjoiZjY5NmMxOTZhNmQwNzFjMTRjZGRlMTU2NDgwMzI2NjY4ZGI2NGYyZDUwZGZlOTU5N2M3MmVhYzg4M2Q2MjIxMTM2OTNkYjczN2Y0MzY5NWYiLCJpYXQiOjE1MTk2OTg3MzMsIm5iZiI6MTUxOTY5ODczMywiZXhwIjoxNTUxMjM0NzMzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.fHdyK1QXuyUFLhe1kH7fOpjtwxMnwI35K4mvAdaTtuaODvBeo5tPPKS8b9kfqWwEu4d6uffaPTj5xyf4Ffb4OhBdZ6iF1bvStWUcAHU5650_VrY-pPqrH3GIKcKy134Sjmp1TMEGZvNWHiE_oGXgvLNfrgzB3bhWy2y2pFQi55-hkvI49DbWD7IiUgtX_rDsrjNh4Fa3wRNllLnIFDKYLBPBfaxYzGFdfTl6-LhdSVbbfTEnSnJI1wHdwF9rIkydfMCqvFLu4JsQqFmRTSmbdVtQkO9V0MaCGgRGrFBTQokK4AfQVJTPU7ATP21QcXI6h_BHS5GzyK4LuoBVqKpsJL_H_xhGWSyG9x1MpWfhYspKAUblopONHFplhHUByPNM0OlU_Rh4M-6GnEFavun-YuhudaPXY8zgaiB3Wpegf2Wve6iVj9hmTurs5iw7lvz_RcU7V56GrxngtX5GuVBB2e4_frYPeHM3qevqOajawRDuggOW6WhSHi0grKH-gLhK3eBkT0FA_vfTUJ3Npy4CFZrx6Lu31IovUUB--3LfLawkyYgCUzZQFuzJwA3E_uW_Csk9jYAsJWeRL0EG0cJpwR24f6c1lfG_Mo701WPFsAoKlA4LuswXvpp9TYKqwu8al9L9VDsV-8sdz7t4OVQ39eJ6DwMwaj_9_r5m2o2_v8Q';
    protected $token_name = 'Cordell Hagenes2018-02-27 02:32:13';

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
