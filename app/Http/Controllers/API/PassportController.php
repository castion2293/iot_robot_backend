<?php

namespace App\Http\Controllers\API;

use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Validator;

class PassportController extends Controller
{
    public $successStatus = 200;
    public $errorStatue = 401;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token_name = $user->name . Carbon::now();
            $success['id'] = $user->id;
            $success['token'] = $user->createToken($token_name)->accessToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['photo'] = $user->photo;
            $success['token_name'] = $token_name;

            return response()->json($success, $this->successStatus);
        }
        else {
            return response()->json(['message' => '電子郵件/密碼 錯誤'], $this->errorStatue);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyAPP')->accessToken;
        $success['name'] = $user->name;

        return response()->json($success, $this->successStatus);
    }

    public function logout(Request $request)
    {
        DB::table('oauth_access_tokens')->where('name', $request->token_name)->delete();

        return response()->json([], $this->successStatus);
    }

    public function getDetails()
    {
//        $user = Auth::user();
//        $robot = $user->robots()->get()->first();
//
//        return response()->json(['user' => $user, 'robot' => $robot], $this->successStatus);
        return response()->json([''], $this->successStatus);
    }
}
