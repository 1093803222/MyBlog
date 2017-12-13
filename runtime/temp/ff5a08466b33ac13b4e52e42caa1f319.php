<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"F:\halloword\xinleiBlog\public/../application/admin\view\show\_sqlbackups\index.html";i:1504939905;}*/ ?>
﻿
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>数据列表页面</title>
    <!-- layui.css -->
    <link href="__public__/plugin/layui/css/layui.css" rel="stylesheet" />
    <style>
        .layui-btn-small {
            padding: 0 15px;
        }

        .layui-form-checkbox {
            margin: 0;
        }

        tr td:not(:nth-child(0)),
        tr th:not(:nth-child(0)) {
            text-align: center;
        }

        #dataConsole {
            text-align: center;
        }
        /*分页页容量样式*/
        /*可选*/
        .layui-laypage {
            display: block;
        }

        /*可选*/
        .layui-laypage > * {
            float: left;
        }
        /*可选*/
        .layui-laypage .laypage-extend-pagesize {
            float: right;
        }
        /*可选*/
        .layui-laypage:after {
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }

        /*必须*/
        .layui-laypage .laypage-extend-pagesize {
            height: 30px;
            line-height: 30px;
            margin: 0px;
            border: none;
            font-weight: 400;
        }
        /*分页页容量样式END*/
    </style>
</head>
<body>
<fieldset id="dataList" class="layui-elem-field layui-field-title sys-list-field" style="display:none;">
    <legend style="text-align:center;">数据库备份列表</legend>
    <div class="layui-input-inline" style="width:auto">
        <a id="article-type-add" is="backup" class="layui-btn layui-btn-normal">添加备份 <i class="layui-icon">&#xe61f;</i></a>
    </div>
    <div class="layui-field-box">
        <div id="dataContent" class="">

        </div>
    </div>
</fieldset>
<!-- layui.js -->
<script src="__public__/plugin/layui/layui.js"></script>
<!-- layui规范化用法 -->
<script type="text/javascript">
    layui.config({
        base: '__public__/js/'
    }).use('backup');


</script>
</body>
</html>