<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserResetAvatarRequest;
use App\Http\Requests\UserResetPasswordRequest;
use App\Http\Requests\UserResetProfileRequest;
use App\User;
use App\UserSetting;
use Auth;
use Carbon\Carbon;
use DB;
use Image;
use Illuminate\Http\Request;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return Auth::user()->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function resetUserProfile(UserResetProfileRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);


        // user setting for dynamoDB
        $userSetting = UserSetting::find($user->id);

        $userSetting->name = $user->name;
        $userSetting->email = $user->email;
        $userSetting->save();

        return $this->resetToken($user, $request->token_name);
    }

    public function resetUserPassword(UserResetPasswordRequest $request)
    {
        $user = auth()->user();

        if (password_verify($request->old_password, $user->password)) {
            $user->update([
                'password' =>  bcrypt($request->password)
            ]);

            return $this->resetToken($user, $request->token_name);
        } else {
            return response()->json(['error' => '舊密碼輸入錯誤'], 404);
        }
    }

    public function resetUserAvatar(UserResetAvatarRequest $request)
    {
        $imageData = $request->get('avatar');

        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Storage::disk('s3')->put('/profile_pic/'.$fileName, Image::make($imageData)->stream()->__toString(), 'public');

        $user = auth()->user();

        // check if user is not first time to change profile image, delete the old one
        if ($user->photo != 'https://s3-ap-northeast-1.amazonaws.com/iot-robot-front-pics/web_pics/Users-User-Male-4-icon.png') {
            $leng = strlen('https://s3-ap-northeast-1.amazonaws.com/iot-robot-front-pics');
            $oldpath = substr($user->photo, $leng);
            Storage::disk('s3')->delete($oldpath);
        }

        $user->update([
            'photo' => 'https://s3-ap-northeast-1.amazonaws.com/iot-robot-front-pics/profile_pic/' . $fileName,
        ]);

        return $this->resetToken($user, $request->token_name);
    }

    public function getUserAlarmSetting()
    {
        $user = auth()->user();

        // user setting for dynamoDB
        $userSetting = UserSetting::find($user->id);

        return response()->json([
            'enable' => $userSetting->enable,
            'level_1' => $userSetting->level_1,
            'level_2' => $userSetting->level_2,
            'level_4' => $userSetting->level_4,
            'level_8' => $userSetting->level_8,
        ]);
    }

    public function resetUserAlarmSetting(Request $request)
    {
        $request->validate([
            'enable' => 'boolean',
            'level_1' => 'boolean',
            'level_2' => 'boolean',
            'level_4' => 'boolean',
            'level_8' => 'boolean'
        ]);

        $user = auth()->user();

        // user setting for dynamoDB
        $userSetting = UserSetting::find($user->id);

        $userSetting->enable = $request->enable;
        $userSetting->level_1 = $request->level_1;
        $userSetting->level_2 = $request->level_2;
        $userSetting->level_4 = $request->level_4;
        $userSetting->level_8 = $request->level_8;
        $userSetting->save();

        return response()->json([
            'enable' => $userSetting->enable,
            'level_1' => $userSetting->level_1,
            'level_2' => $userSetting->level_2,
            'level_4' => $userSetting->level_4,
            'level_8' => $userSetting->level_8,
        ]);
    }

    private function resetToken($user, $tokenName)
    {
        DB::table('oauth_access_tokens')->where('name', $tokenName)->delete();

        $token_name = $user->name . Carbon::now();
        $success['id'] = $user->id;
        $success['token'] = $user->createToken($token_name)->accessToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['photo'] = $user->photo;
        $success['token_name'] = $token_name;

        return $success;
    }
}
