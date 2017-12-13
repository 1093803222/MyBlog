<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"F:\halloword\xinleiBlog\public/../application/index\view\show\_timeline\index.html";i:1504665323;s:72:"F:\halloword\xinleiBlog\public/../application/index\view\public\nav.html";i:1509881764;s:75:"F:\halloword\xinleiBlog\public/../application/index\view\public\footer.html";i:1504595498;}*/ ?>
﻿<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; Charset=gb2312">
    <meta http-equiv="Content-Language" content="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <title><?php echo $title; ?> - 点点滴滴 - 时光轴</title>
    <link rel="shortcut icon" href="__index__/images/Logo_40.png" type="image/x-icon">
    <!--Layui-->
    <link href="__index__/plug/layui/css/layui.css" rel="stylesheet"/>
    <!--font-awesome-->
    <link href="__index__/plug/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- animate.css -->
    <link href="__index__/css/animate.min.css" rel="stylesheet"/>
    <!--全局样式表-->
    <link href="__index__/css/global.css" rel="stylesheet"/>
    <!-- 本页样式表 -->
    <link href="__index__/css/timeline.css" rel="stylesheet"/>
    <!-- jquery文件引入 -->
    <script src="__index__/js/jquery2.1.4.js"></script>
    <!-- 百度编辑器 -->
    <script type="text/javascript" charset="utf-8" src="__public__/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="__public__/ueditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="__public__/ueditor/lang/zh-cn/zh-cn.js"></script>

    <style>
        #editor {
            width: 750px;
            margin: 5% auto;
            height: 150px;
        }

        .faBiao {
            margin: 3% 20%;
        }
    </style>
</head>
<body>
<!-- 导航 -->
<nav class="blog-nav layui-header">
    <div class="blog-container">
        <!-- QQ互联登陆 -->
        <a href="javascript:;" class="blog-user login <?php if(isset($name)): ?>layui-hide<?php endif; ?>">
            <i class="fa fa-user-circle-o" style="margin:17px 2px 0 3px;color:#c2c2c2;font-size: 30px;"></i>
        </a>
        <?php if(isset($name)): ?>
        <a href="javascript:;" class="blog-user loginout">
            <img src="<?php echo $top; ?>" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
        </a>
        <?php else: ?>
        <a href="javascript:;" class="blog-user layui-hide">
            <img src=""/>
        </a>
        <?php endif; ?>
        <!-- 不落阁 -->
        <a class="blog-logo" href="/index.html"><?php echo $title; ?></a>
        <!-- 导航菜单 -->
        <ul class="layui-nav" lay-filter="nav">
            <li class="layui-nav-item">
                <a href="<?php echo url('index/show.Index/index'); ?>"><i class="fa fa-home fa-fw"></i>&nbsp;网站首页</a>
            </li>
            <li class="layui-nav-item">
                <a href="<?php echo url('index/show.Article/index'); ?>"><i class="fa fa-file-text fa-fw"></i>&nbsp;文章专栏</a>
            </li>
            <li class="layui-nav-item">
                <a href="<?php echo url('index/show.Resource/index'); ?>"><i class="fa fa-tags fa-fw"></i>&nbsp;资源分享</a>
            </li>
            <li class="layui-nav-item">
                <a href="<?php echo url('index/show.Timeline/index'); ?>"><i class="fa fa-hourglass-half fa-fw"></i>&nbsp;点点滴滴</a>
            </li>
            <li class="layui-nav-item">
                <a href="<?php echo url('index/show.About/index'); ?>"><i class="fa fa-info fa-fw"></i>&nbsp;关于本站</a>
            </li>
        </ul>
        <!-- 手机和平板的导航开关 -->
        <a class="blog-navicon" href="javascript:;">
            <i class="fa fa-navicon"></i>
        </a>
    </div>
</nav>
<!-- 主体（一般只改变这里的内容） -->
<div class="blog-body">
    <div class="blog-container">
        <blockquote class="layui-elem-quote sitemap layui-breadcrumb shadow">
            <a href="home.html" title="网站首页">网站首页</a>
            <a href="timeline.html" title="点点滴滴">点点滴滴</a>
            <a><cite>时光轴</cite></a>
        </blockquote>
        <div class="blog-main">
            <div class="child-nav shadow">
                <span class="child-nav-btn child-nav-btn-this" typeName="timeline">时光轴</span>
                <?php if(isset($admin)): ?>
                <span class="child-nav-btn" typeName="note">编写生活笔记</span>
                <?php endif; ?>
            </div>
            <div class="timeline-box shadow">

            </div>

        </div>
    </div>
</div>

<!-- 底部 -->
<footer class="blog-footer">
    <p><span>Copyright</span><span>&copy;</span><span>2017</span><a href="http://www.lyblogs.cn"><?php echo $title; ?></a><span>Design By LY</span></p>
    <p><a href="http://www.miibeian.gov.cn/" target="_blank">蜀ICP备16029915号-1</a></p>
</footer>
<!--侧边导航-->
<ul class="layui-nav layui-nav-tree layui-nav-side blog-nav-left layui-hide" lay-filter="nav">
    <li class="layui-nav-item">
        <a href="/index.html"><i class="fa fa-home fa-fw"></i>&nbsp;网站首页</a>
    </li>
    <li class="layui-nav-item">
        <a href="/article.html"><i class="fa fa-file-text fa-fw"></i>&nbsp;文章专栏</a>
    </li>
    <li class="layui-nav-item">
        <a href="/resource.html"><i class="fa fa-tags fa-fw"></i>&nbsp;资源分享</a>
    </li>
    <li class="layui-nav-item layui-this">
        <a href="/timeline.html"><i class="fa fa-road fa-fw"></i>&nbsp;点点滴滴</a>
    </li>
    <li class="layui-nav-item">
        <a href="/about.html"><i class="fa fa-info fa-fw"></i>&nbsp;关于本站</a>
    </li>
</ul>
<!--分享窗体-->
<div class="blog-share layui-hide">
    <div class="blog-share-body">
        <div style="width: 200px;height:100%;">
            <div class="bdsharebuttonbox">
                <a class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                <a class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                <a class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                <a class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
            </div>
        </div>
    </div>
</div>
<!--遮罩-->
<div class="blog-mask animated layui-hide"></div>
<!--缓存-->
<div class="timeline-cache"></div>
<!-- layui.js -->
<script src="__index__/plug/layui/layui.js"></script>
<!-- 全局脚本 -->
<script src="__index__/js/global.js"></script>
<!-- 本页脚本 -->
<script src="__index__/js/timeline.js"></script>

</body>
</html>