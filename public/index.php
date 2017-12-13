<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
session_start();
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 定义后台样式目录
define('ADMIN_STYLE','/static/admin');
// 定义前台样式目录
define('INDEX_STYLE','/static/index');
// 定义上传路径
define('UPLOAD_PATH','./');
// 定义上传显示路径
define('SHOW_PATH','/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
