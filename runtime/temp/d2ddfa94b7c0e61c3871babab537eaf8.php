<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"F:\halloword\xinleiBlog\public/../application/index\view\show\_article\detail.html";i:1504665274;s:72:"F:\halloword\xinleiBlog\public/../application/index\view\public\nav.html";i:1503328395;s:75:"F:\halloword\xinleiBlog\public/../application/index\view\public\footer.html";i:1504595498;}*/ ?>
﻿<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; Charset=gb2312">
    <meta http-equiv="Content-Language" content="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?> - 文章详情</title>
    <link rel="shortcut icon" href="__index__/images/Logo_40.png" type="image/x-icon">
    <!--Layui-->
    <link href="__index__/plug/layui/css/layui.css" rel="stylesheet" />
    <!--font-awesome-->
    <link href="__index__/plug/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!--全局样式表-->
    <link href="__index__/css/global.css" rel="stylesheet" />
    <!-- 比较好用的代码着色插件 -->
    <link href="__index__/css/prettify.css" rel="stylesheet" />
    <!-- 本页样式表 -->
    <link href="__index__/css/detail.css" rel="stylesheet" />
    <style>
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
            <li class="layui-nav-item <?php if($fileName == 'index.html'): ?>layui-this<?php endif; ?>">
                <a href="<?php echo url('index/show.Index/index'); ?>"><i class="fa fa-home fa-fw"></i>&nbsp;网站首页</a>
            </li>
            <li class="layui-nav-item <?php if($fileName == 'article.html'): ?>layui-this<?php endif; ?>">
                <a href="<?php echo url('index/show.Article/index'); ?>"><i class="fa fa-file-text fa-fw"></i>&nbsp;文章专栏</a>
            </li>
            <li class="layui-nav-item <?php if($fileName == 'resource.html'): ?>layui-this<?php endif; ?>">
                <a href="<?php echo url('index/show.Resource/index'); ?>"><i class="fa fa-tags fa-fw"></i>&nbsp;资源分享</a>
            </li>
            <li class="layui-nav-item <?php if($fileName == 'timeline.html'): ?>layui-this<?php endif; ?>">
                <a href="<?php echo url('index/show.Timeline/index'); ?>"><i class="fa fa-hourglass-half fa-fw"></i>&nbsp;点点滴滴</a>
            </li>
            <li class="layui-nav-item <?php if($fileName == 'about.html'): ?>layui-this<?php endif; ?>">
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
                <a href="<?php echo url('index/show.Index/index'); ?>" title="网站首页">网站首页</a>
                <a href="<?php echo url('index/show.Article/index'); ?>" title="文章专栏">文章专栏</a>
                <a><cite>基于layui的laypage扩展模块！</cite></a>
            </blockquote>
            <div class="blog-main">
                <input type="hidden" id="article_id" value="<?php echo $id; ?>">
                <div class="blog-main-left">
                    <!-- 文章内容（使用Kingeditor富文本编辑器发表的） -->
                    <?php echo $detailData; ?>
                    <!-- 评论区域 -->
                    <div class="blog-module shadow" style="box-shadow: 0 1px 8px #a6a6a6;">
                        <fieldset class="layui-elem-field layui-field-title" style="margin-bottom:0">
                            <legend>来说两句吧</legend>
                            <div class="layui-field-box">
                                <form class="layui-form blog-editor" action="">
                                    <div class="layui-form-item">
                                        <textarea name="editorContent" lay-verify="content" id="remarkEditor" placeholder="请输入内容" class="layui-textarea layui-hide"></textarea>
                                    </div>
                                    <div class="layui-form-item">
                                        <button class="layui-btn" lay-submit="formRemark" lay-filter="formRemark">提交评论</button>
                                    </div>
                                </form>
                            </div>
                        </fieldset>
                        <div class="blog-module-title">最新评论</div>
                        <ul class="blog-comment">
                            <?php foreach($comment['parent'] as $value): ?>
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
                                <?php foreach($comment['child'] as $value2): if($value2['pid'] == $value['id']): ?>
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
                <div class="blog-main-right">
                    <!--右边悬浮 平板或手机设备显示-->
                    <div class="category-toggle"><i class="fa fa-chevron-left"></i></div><!--这个div位置不能改，否则需要添加一个div来代替它或者修改样式表-->
                    <div class="article-category shadow">
                        <div class="article-category-title">分类导航</div>
                        <!-- 点击分类后的页面和artile.html页面一样，只是数据是某一类别的 -->
                        <?php echo $typeData; ?>
                        <div class="clear"></div>
                    </div>

                    <div class="blog-module shadow">
                        <div class="blog-module-title">随便看看</div>
                        <ul class="fa-ul blog-module-ul">
                            <?php foreach($randArticle as $v): ?>
                            <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail/<?php echo $v['id']; ?>.html"><?php echo $v['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
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
        <li class="layui-nav-item layui-this">
            <a href="/article.html"><i class="fa fa-file-text fa-fw"></i>&nbsp;文章专栏</a>
        </li>
        <li class="layui-nav-item">
            <a href="/resource.html"><i class="fa fa-tags fa-fw"></i>&nbsp;资源分享</a>
        </li>
        <li class="layui-nav-item">
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
    <!--loading图片的路径-->
    <div class="loading" style="display: none">__index__/images/loading.gif</div>
    <!-- layui.js -->
    <script src="__index__/plug/layui/layui.js"></script>
    <!-- 自定义全局脚本 -->
    <script src="__index__/js/global.js"></script>
    <!-- 比较好用的代码着色插件 -->
    <script src="__index__/js/prettify.js"></script>
    <!-- 本页脚本 -->
    <script src="__index__/js/detail.js"></script>
</body>
</html>