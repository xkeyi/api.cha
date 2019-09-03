<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use Cache;
use App\Models\User;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verificationData = Cache::get($request->verification_key);

        if (!$verificationData) {
            return $this->response->error('短信验证码已失效', 422);
        }

        if (!hash_equals($verificationData['code'], $request->verification_code)) {
            // 返回 401
            return $this->response->errorUnauthorized('验证码错误');
        }

        $user = User::create([
            'username' => $request->username,
            'phone' => $verificationData['phone'],
            'password' => bcrypt($request->password),
        ]);

        // 清除短信验证码缓存
        Cache::forget($request->verification_key);

        return $this->response->created();
    }
}
