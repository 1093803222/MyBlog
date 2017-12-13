<?php

// +----------------------------------------------------------------------
// | 缓存设置
// +----------------------------------------------------------------------
return [
    'cache'  => [
        //缓存类型,支持的缓存类型包括file、memcache、wincache、sqlite、redis和xcache。
        'type'   => 'File',
        //指定缓存目录
        'path'   => CACHE_PATH,
        //缓存前缀
        'prefix' => '',
        //缓存有效期
        'expire' => 0,
    ],
];