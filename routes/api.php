<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array', 'bindings', 'cors'],
], function ($api) {
    /** 登录相关 */
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        // 图片验证码
        $api->post('captchas', 'CaptchasController@store')->name('api.captchas.store');
        // 发送短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')->name('api.verificationCodes.store');
        // 用户注册
        $api->post('users', 'UsersController@store')->name('api.users.store');
    });


    /** 其他 */
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
        /** 游客可以访问的接口 */
        // 用户是否存在
        $api->post('user/exists', 'UsersController@exists')->name('api.user.exists');

        /** 需要用户登录才能访问的接口 */
        $api->group(['middleware' => 'api.auth'], function ($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')->name('api.user.show');
        });
    });

    $api->get('version', function () {
        return response('this is version v1');
    });
});

$api->version('v2', function ($api) {
    $api->get('version', function () {
        return response('this is version v2');
    });
});
