<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use Cache;
use App\Models\User;
use App\Transformers\UserTransformer;
use Auth;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verificationData = Cache::get($request->verification_key);

        if (!$verificationData) {
            return $this->response->error('短信验证码已失效', 422);
        }

        if (!hash_equals($verificationData['code'], $request->verification_code)) {
            // 返回 403
            return $this->response->errorForbidden('验证码错误');
        }

        $user = User::create([
            'username' => $request->username,
            'phone' => $verificationData['phone'],
            'password' => bcrypt($request->password),
        ]);

        // 清除短信验证码缓存
        Cache::forget($request->verification_key);

        // return $this->response->created();
        // return $this->response->item($user, new UserTransformer())
        //                     ->setMeta([
        //                         'access_token' => Auth::guard('api')->fromUser($user),
        //                         'token_type' => 'Bearer',
        //                         'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        //                     ])
        //                     ->setStatusCode(201);

        $result = [
            'access_token' => Auth::guard('api')->fromUser($user),
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ];

        return $this->response->array($result)->setStatusCode(201);
    }

    public function exists(Request $request)
    {
        if ($request->has('username')) {
            $exists = User::where('username', $request->username)->exists();
            return $this->response->array(['success' => !$exists]);
        }

        if ($request->has('phone')) {
            $exists = User::where('phone', $request->phone)->exists();
            return $this->response->array(['success' => !$exists]);
        }

        \abort(400);
    }

    public function me()
    {
        $user = $this->user(); // dingo/api 的中间键 api.auth 提供的方法

        return $this->response->item($user, new UserTransformer());
    }
}
