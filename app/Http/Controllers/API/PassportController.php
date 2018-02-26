<?php

namespace App\Http\Controllers\API;

use App\User;
use Auth;
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
        //return response()->json(['email' => request('email'), 'password' => request('password')]);

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['photo'] = $user->photo;

            return response()->json($success, $this->successStatus);
        }
        else {
            return response()->json(['error' => '電子郵件/密碼 錯誤'], $this->errorStatue);
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

    public function logout()
    {
        DB::table('oauth_access_tokens')->where('user_id', Auth::user()->id)->delete();

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
