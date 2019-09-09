<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\AuthorizationRequest;
use Auth;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        $username_credentials['password'] = $phone_credentials['password'] = $request->password;
        $username_credentials['username'] = $request->username;
        $phone_credentials['phone'] = $request->username;

        if ($token = Auth::guard('api')->attempt($username_credentials)) {
            return $this->respondWithToken($token);
        } else if ($token = Auth::guard('api')->attempt($phone_credentials)) {
            return $this->respondWithToken($token);
        } else {
            return $this->response->errorUnauthorized(trans('auth.failed'));
        }
    }


}
