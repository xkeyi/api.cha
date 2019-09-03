<?php

return [
    // 是否需要真实发送短信
    'send_enabled' => env('SEND_SMS_ENABLED', false),

    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'juhe',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],

        'yunpian' => [
            'api_key' => env('YUNPIAN_API_KEY'),
        ],

        'aliyun' => [
            'access_key_id' => '',
            'access_key_secret' => '',
            'sign_name' => '',
        ],

        'juhe' => [
            'app_key' => env('JUHE_SMS_APP_KEY'),
        ],
    ],
];
