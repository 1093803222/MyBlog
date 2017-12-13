<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"F:\halloword\xinleiBlog\public/../application/index\view\show\_about\index.html";i:1504665264;s:72:"F:\halloword\xinleiBlog\public/../application/index\view\public\nav.html";i:1509881764;s:75:"F:\halloword\xinleiBlog\public/../application/index\view\public\footer.html";i:1504595498;}*/ ?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; Charset=gb2312">
    <meta http-equiv="Content-Language" content="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?> - 关于本站</title>
    <link rel="shortcut icon" href="__index__/images/Logo_40.png" type="image/x-icon">
    <!--Layui-->
    <link href="__index__/plug/layui/css/layui.css" rel="stylesheet" />
    <!--font-awesome-->
    <link href="__index__/plug/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!--全局样式表-->
    <link href="__index__/css/global.css" rel="stylesheet" />
    <!-- 本页样式表 -->
    <link href="__index__/css/about.css" rel="stylesheet" />
    <style>
        .top_img{ width:100px; height:100px;
            -webkit-border-radius:50%;
            -moz-border-radius:50%;
            border-radius:50%;}
        .reload-div{text-align: center;user-select: none;color:#C9C5C5;}
        .reload-div a{color:#C9C5C5;}
        .reload-div a:hover{color:#00b7ee;}
    </style>
</head>
<body>
    <!-- 导航 -->
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
                <a><cite>关于本站</cite></a>
            </blockquote>
            <div class="blog-main">
                <div class="layui-tab layui-tab-brief shadow" lay-filter="tabAbout">
                    <ul class="layui-tab-title">
                        <li lay-id="1">关于作者</li>
                        <li lay-id="2">友情链接</li>
                        <li lay-id="3">留言墙</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item">
                            <div class="aboutinfo">
                                <div class="aboutinfo-figure">
                                    <img class="top_img" src="<?php echo $authorAbout['top_img']; ?>" alt="<?php echo $authorAbout['name']; ?>" />
                                </div>
                                <p class="aboutinfo-nickname"><?php echo $authorAbout['name']; ?></p>
                                <p class="aboutinfo-introduce"><?php echo $authorAbout['introduce']; ?></p>
                                <p class="aboutinfo-location"><i class="fa fa-location-arrow"></i>&nbsp;<?php echo $authorAbout['address']; ?></p>
                                <hr />
                                <div class="aboutinfo-contact">
                                    <a target="_blank" title="QQ交流" href="<?php echo $authorAbout['qq_link']; ?>"><i class="fa fa-qq fa-2x"></i></a>
                                    <a target="_blank" title="给我写信" href="<?php echo $authorAbout['email_link']; ?>"><i class="fa fa-envelope fa-2x"></i></a>
                                    <a target="_blank" title="新浪微博" href="<?php echo $authorAbout['sina_link']; ?>"><i class="fa fa-weibo fa-2x"></i></a>
                                    <a target="_blank" title="码云" href="<?php echo $authorAbout['git_link']; ?>"><i class="fa fa-git fa-2x"></i></a>
                                </div>
                                <fieldset class="layui-elem-field layui-field-title">
                                    <legend>简介</legend>
                                    <div class="layui-field-box aboutinfo-abstract abstract-bloger">
                                        <?php echo htmlspecialchars_decode($authorAbout['messages']); ?>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <!--关于作者End-->

                        <div class="layui-tab-item">
                            <div class="aboutinfo">
                                <div class="aboutinfo-figure">
                                    <img src="__index__/images/handshake.png" alt="<?php echo $linkAbout['name']; ?>" />
                                </div>
                                <p class="aboutinfo-nickname"><?php echo $linkAbout['name']; ?></p>
                                <p class="aboutinfo-introduce"><?php echo $linkAbout['introduce']; ?></p>
                                <p class="aboutinfo-location">
                                    <?php echo htmlspecialchars_decode($linkAbout['tag']); ?>
                                </p>
                                <hr />
                                <div class="aboutinfo-contact">
                                    <p style="font-size:2em;"><?php echo $linkAbout['friendmsg']; ?></p>
                                </div>
                                <fieldset class="layui-elem-field layui-field-title">
                                    <legend>Friend Link</legend>
                                    <div class="layui-field-box">
                                        <ul class="friendlink">
                                            <?php foreach($link as $value): ?>
                                            <li>
                                                <a target="_blank" href="<?php echo $value['link_url']; ?>" title="Layui" class="friendlink-item">
                                                    <p class="friendlink-item-pic"><img src="<?php echo $value['link_img']; ?>" alt="<?php echo $value['link_name']; ?>" /></p>
                                                    <p class="friendlink-item-title"><?php echo $value['link_name']; ?></p>
                                                    <p class="friendlink-item-domain"><?php echo $value['link_url']; ?></p>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <!--友情链接End-->

                        <div class="layui-tab-item">
                            <div class="aboutinfo">
                                <div class="aboutinfo-figure">
                                    <img src="__index__/images/messagewall.png" alt="留言墙" />
                                </div>
                                <p class="aboutinfo-nickname">留言墙</p>
                                <p class="aboutinfo-introduce">本页面可留言、吐槽、提问。欢迎灌水，杜绝广告！</p>
                                <p class="aboutinfo-location">
                                    <i class="fa fa-clock-o"></i>&nbsp;<span id="time"></span>
                                </p>
                                <hr />
                                <div class="aboutinfo-contact">
                                    <p style="font-size:2em;">沟通交流，拉近你我！</p>
                                </div>
                                <fieldset class="layui-elem-field layui-field-title">
                                    <legend>Leave a message</legend>
                                    <div class="layui-field-box">
                                        <div class="leavemessage" style="text-align:initial">
                                            <form class="layui-form blog-editor" action="">
                                                <div class="layui-form-item">
                                                    <textarea name="editorContent" lay-verify="content" id="remarkEditor" placeholder="请输入内容" class="layui-textarea layui-hide"></textarea>
                                                </div>
                                                <div class="layui-form-item">
                                                    <button class="layui-btn" lay-submit="formLeaveMessage" lay-filter="formLeaveMessage">提交留言</button>
                                                </div>
                                            </form>
                                            <ul class="blog-comment">
                                                <?php foreach($message['parent'] as $value): ?>
                                                <!------------------------------一级-------------------------------------------------->
                                                <li>
                                                    <div class="comment-parent"  remark-id="<?php echo $value['id']; ?>">
                                                        <img src="<?php echo $value['top']; ?>" alt="<?php echo $value['name']; ?>" />
                                                        <div class="info">
                                                            <span class="username"><?php echo $value['name']; ?></span>
                                                        </div>
                                                        <div class="content">
                                                            <?php echo $value['content']; ?>
                                                        </div>
                                                        <p class="info info-footer"><span class="time"><?php echo $value['time']; ?></span><a class="btn-reply" href="javascript:;" onclick="btnReplyClick(this)">回复</a></p>
                                                    </div>
                                                    <?php foreach($message['child'] as $value2): if($value2['pid'] == $value['id']): ?>
                                                    <hr />
                                                        <!----------------------------二级---------------------------------------------------->
                                                        <div class="comment-child">
                                                            <img src="<?php echo $value2['top']; ?>" alt="<?php echo $value2['name']; ?>" />
                                                            <div class="info">
                                                                <span class="username"><?php echo $value2['name']; ?></span><span><?php echo $value2['content']; ?></span>
                                                            </div>
                                                            <p class="info"><span class="time"><?php echo $value2['time']; ?></span></p>
                                                        </div>
                                                        <?php endif; endforeach; ?>
                                                    <!-- 回复表单默认隐藏 -->
                                                    <div class="replycontainer layui-hide">
                                                        <form class="layui-form" action="">
                                                            <div class="layui-form-item">
                                                                <textarea name="replyContent" lay-verify="replyContent" placeholder="请输入回复内容" class="layui-textarea" style="min-height:80px;"></textarea>
                                                            </div>
                                                            <div class="layui-form-item">
                                                                <button class="layui-btn layui-btn-mini" lay-submit="formReply" lay-filter="formReply">提交</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <div class="reload-div"><a id="click-reload" href="javascript:;">点击加载更多</a></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <!--留言墙End-->

                    </div>
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
        <li class="layui-nav-item">
            <a href="/timeline.html"><i class="fa fa-road fa-fw"></i>&nbsp;点点滴滴</a>
        </li>
        <li class="layui-nav-item layui-this">
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
    <!--loading图片的路径-->
    <div class="loading" style="display: none">__index__/images/loading.gif</div>
    <!-- layui.js -->
    <script src="__index__/plug/layui/layui.js"></script>
    <!-- 全局脚本 -->
    <script src="__index__/js/global.js"></script>
    <!-- 本页脚本 -->
    <script src="__index__/js/about.js"></script>
</body>
</html>