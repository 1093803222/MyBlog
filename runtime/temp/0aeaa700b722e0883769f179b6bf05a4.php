<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"F:\halloword\xinleiBlog\public/../application/admin\view\show\_index\index.html";i:1504924422;}*/ ?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>后台管理系统</title>
    <link rel="shortcut icon" href="__public__/images/Logo_40.png" type="image/x-icon">
    <!-- layui.css -->
    <link href="__public__/plugin/layui/css/layui.css" rel="stylesheet"/>
    <!-- font-awesome.css -->
    <link href="__public__/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- animate.css -->
    <link href="__public__/css/animate.min.css" rel="stylesheet"/>
    <!-- 本页样式 -->
    <link href="__public__/css/main.css" rel="stylesheet"/>
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <!--顶部-->
    <div class="layui-header">
        <div class="ht-console">
            <div class="ht-user">
                <img src="__public__/images/Logo_40.png"/>
                <a class="ht-user-name">超级管理员</a>
            </div>
        </div>
        <span class="sys-title">后台管理系统</span>
        <ul class="ht-nav">
            <li class="ht-nav-item">
                <a target="_blank" href="/index.html">前台入口</a>
            </li>
            <li class="ht-nav-item">
                <a href="javascript:;" id="individuation"><i class="fa fa-tasks fa-fw" style="padding-right:5px;"></i>个性化</a>
            </li>
            <li class="ht-nav-item">
                <a href="javascript:;" class="loginOut"><i class="fa fa-power-off fa-fw"></i>注销</a>
            </li>
        </ul>
    </div>
    <!--侧边导航-->
    <div class="layui-side">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree" lay-filter="leftnav">
                <li class="layui-nav-item layui-this">
                    <a href="javascript:;"><i class="fa fa-home"></i>首页</a>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="fa fa-file-text"></i>内容管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="/admin-article.html" data-id="1">文章管理</a></dd>
                        <dd><a href="javascript:;" data-url="/admin-article-type-list.html" data-id="2">文章分类管理</a></dd>
                        <dd><a href="javascript:;" data-url="/admin-article-comment.html" data-id="3">文章评论</a></dd>
                        <dd><a href="javascript:;" data-url="/admin-resource.html" data-id="4">资源管理</a></dd>
                        <dd><a href="javascript:;" data-url="/admin-resource-type.html" data-id="5">资源分类管理</a></dd>
                        <dd><a href="javascript:;" data-url="/admin-timeline.html" data-id="6">时光轴管理</a></dd>
                        <dd><a href="javascript:;" data-url="/admin-note.html" data-id="7">笔记本管理</a></dd>
                        <dd><a href="javascript:;" data-url="/article-recycle.html" data-id="8">文章回收站</a></dd>
                        <dd><a href="javascript:;" data-url="/resource-recycle.html" data-id="9">资源回收站</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="fa fa-user"></i>用户管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="/userList.html" data-id="21">全部用户</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="fa fa-info"></i>关于本站</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="/admin-author.html" data-id="31">关于作者</a></dd>
                        <dd><a href="javascript:;" data-url="/admin-link.html" data-id="32">友情链接</a></dd>
                        <dd><a href="javascript:;" data-url="/admin-message.html" data-id="33">留言墙</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="fa fa-info"></i>网站配置</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="/SQLbackups.html" data-id="41">数据库备份</a></dd>
                    </dl>
                </li>

            </ul>
        </div>
    </div>
    <!--收起导航-->
    <div class="layui-side-hide layui-bg-cyan">
        <i class="fa fa-long-arrow-left fa-fw"></i>收起导航
    </div>
    <!--主体内容-->
    <div class="layui-body">
        <div style="margin:0;position:absolute;top:4px;bottom:0px;width:100%;" class="layui-tab layui-tab-brief"
             lay-filter="tab" lay-allowclose="true">
            <ul class="layui-tab-title">
                <li lay-id="0" class="layui-this">首页</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <p style="padding: 10px 15px; margin-bottom: 20px; margin-top: 10px; border:1px solid #ddd;display:inline-block;">
                        本次登陆
                        <span style="padding-left:1em;">IP：<?php echo $showInfo['ip']; ?></span>
                        <span style="padding-left:1em;">地点：<?php echo $showInfo['city']; ?></span>
                        <span style="padding-left:1em;">时间：<?php echo $showInfo['time']; ?></span>
                    </p>
                    <fieldset class="layui-elem-field layui-field-title">
                        <legend>统计信息</legend>
                        <div class="layui-field-box">
                            <div style="display: inline-block; width: 100%;">
                                <div class="ht-box layui-bg-blue">
                                    <p><?php echo $showInfo['userCount']; ?></p>
                                    <p>用户总数</p>
                                </div>
                                <div class="ht-box layui-bg-green">
                                    <p><?php echo $showInfo['todayLogin']; ?></p>
                                    <p>今日登陆</p>
                                </div>
                                <div class="ht-box layui-bg-orange">
                                    <p><?php echo $showInfo['articleCount']; ?></p>
                                    <p>文章总数</p>
                                </div>
                                <div class="ht-box layui-bg-cyan">
                                    <p><?php echo $showInfo['resourceCount']; ?></p>
                                    <p>资源总数</p>
                                </div>
                                <div class="ht-box layui-bg-black">
                                    <p><?php echo $showInfo['messageCount']; ?></p>
                                    <p>留言总数</p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="layui-elem-field layui-field-title">
                        <legend>系统参数</legend>
                            <table class="layui-table">
                                <colgroup>
                                    <col width="150">
                                    <col width="200">
                                    <col>
                                </colgroup>
                                <thead>
                                <?php foreach($showInfo['server_info'] as $key => $v): ?>
                                <tr>
                                    <td style="text-align: right;padding-right: 10%"><?php echo $key; ?></td>
                                    <td style="text-align: left;padding-left: 20%"><?php echo $v; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <!--底部信息-->
    <div class="layui-footer">
        <p style="line-height:44px;text-align:center;">后台管理系统 - Design By LY</p>
    </div>

    <!--个性化设置-->
    <div class="individuation animated flipOutY layui-hide">
        <ul>
            <li><i class="fa fa-cog" style="padding-right:5px"></i>个性化</li>
        </ul>
        <div class="explain">
            <small>从这里进行系统设置和主题预览</small>
        </div>
        <div class="setting-title">设置</div>
        <div class="setting-item layui-form">
            <span>侧边导航</span>
            <input type="checkbox" lay-skin="switch" lay-filter="sidenav" lay-text="ON|OFF" checked>
        </div>
        <!--<div class="setting-item layui-form">-->
            <!--<span>管家提醒</span>-->
            <!--<input type="checkbox" lay-skin="switch" lay-filter="steward" lay-text="ON|OFF" checked>-->
        <!--</div>-->
        <div class="setting-title">主题</div>
        <div class="setting-item skin skin-default" data-skin="skin-default">
            <span>低调优雅</span>
        </div>
        <div class="setting-item skin skin-deepblue" data-skin="skin-deepblue">
            <span>蓝色梦幻</span>
        </div>
        <div class="setting-item skin skin-pink" data-skin="skin-pink">
            <span>姹紫嫣红</span>
        </div>
        <div class="setting-item skin skin-green" data-skin="skin-green">
            <span>一碧千里</span>
        </div>
    </div>
</div>
<!-- layui.js -->
<script src="__public__/plugin/layui/layui.js"></script>
<!-- layui规范化用法 -->
<script type="text/javascript">
    layui.config({
        base: '__public__/js/'
    }).use('main');
</script>
</body>
</html>