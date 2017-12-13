<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"F:\halloword\xinleiBlog\public/../application/index\view\show\_index\index.html";i:1509881952;s:72:"F:\halloword\xinleiBlog\public/../application/index\view\public\nav.html";i:1509881764;s:75:"F:\halloword\xinleiBlog\public/../application/index\view\public\footer.html";i:1504595498;}*/ ?>
﻿<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; Charset=gb2312">
    <meta http-equiv="Content-Language" content="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?> - 一个PHP程序员的个人博客网站</title>
    <link rel="shortcut icon" href="__index__/images/Logo_40.png" type="image/x-icon">
    <!--Layui-->
    <link href="__index__/plug/layui/css/layui.css" rel="stylesheet" />
    <!--font-awesome-->
    <link href="__index__/plug/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!--全局样式表-->
    <link href="__index__/css/global.css" rel="stylesheet" />
    <!-- 本页样式表 -->
    <link href="__index__/css/home.css" rel="stylesheet" />
    <!-- jquery文件引入 -->
    <script src="__index__/js/jquery2.1.4.js"></script>
    <!-- 天气样式 -->
    <link href="__index__/css/weather.css" rel="stylesheet" />
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
        <!-- canvas -->
        <canvas id="canvas-banner" style="background: #393D49;"></canvas>
        <!--为了及时效果需要立即设置canvas宽高，否则就在home.js中设置-->
        <script type="text/javascript">
            var canvas = document.getElementById('canvas-banner');
            canvas.width = window.document.body.clientWidth - 10;//减去滚动条的宽度
            if (screen.width >= 992) {
                canvas.height = window.innerHeight * 1 / 3;
            } else {
                canvas.height = window.innerHeight * 2 / 7;
            }
        </script>
        <!-- 这个一般才是真正的主体内容 -->
        <div class="blog-container">
            <div class="blog-main">
                <!-- 网站公告提示 -->
                <div class="home-tips shadow">
                    <i style="float:left;line-height:17px;" class="fa fa-volume-up"></i>
                    <div class="home-tips-container">
                        <span style="color: #009688">当前在线人数：<?php echo $count; ?>人&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $weather->week; ?>&nbsp;&nbsp;<?php echo $weather->weather; ?>&nbsp;&nbsp;<?php echo $weather->templow; ?>℃ ~ <?php echo $weather->temphigh; ?>℃</span>
                        <span style="color: #009688">文海阁 &nbsp;—— &nbsp;一个PHP程序员的个人博客，网站采用Layui为前端框架，目前正在建设中！</span>
                    </div>
                </div>
                <!--左边文章列表-->
                <div class="blog-main-left">
                    <!--
                    <div class="article shadow">
                        <div class="article-left">
                            <img src="__index__/images/cover/201703181909057125.jpg" alt="基于laypage的layui扩展模块（pagesize.js）！" />
                        </div>
                        <div class="article-right">
                            <div class="article-title">
                                <a href="detail.html">基于laypage的layui扩展模块（pagesize.js）！</a>
                            </div>
                            <div class="article-abstract">
                                该模块主要是针对当前版本laypage没有页容量控制功能而制作，使用该模块后即可实现每页显示多少条数据的控制！本人原创，但是可能有可能只对本人的分页写法有用！
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="article-footer">
                            <span><i class="fa fa-clock-o"></i>&nbsp;&nbsp;2017-03-18</span>
                            <span class="article-author"><i class="fa fa-user"></i>&nbsp;&nbsp;Absolutely</span>
                            <span><i class="fa fa-tag"></i>&nbsp;&nbsp;<a href="#">Web前端</a></span>
                            <span class="article-viewinfo"><i class="fa fa-eye"></i>&nbsp;0</span>
                            <span class="article-viewinfo"><i class="fa fa-commenting"></i>&nbsp;4</span>
                        </div>
                    </div>-->
                       <!--<div class="article" style="border:0;text-align: center;color: #808080;">-->
                           <!--<span style="">点击加载更多</span>-->
                       <!--</div>-->

                </div>
                <!--右边小栏目-->
                <div class="blog-main-right">
                    <div class="blogerinfo shadow">
                        <div class="blogerinfo-figure">
                            <img style="width:100px;height:100px" src="<?php echo $myData['top_img']; ?>" alt="<?php echo $myData['name']; ?>" />
                        </div>
                        <p class="blogerinfo-nickname"><?php echo $myData['name']; ?></p>
                        <p class="blogerinfo-introduce"><?php echo $myData['introduce']; ?></p>
                        <p class="blogerinfo-location"><i class="fa fa-location-arrow"></i>&nbsp;<?php echo $myData['address']; ?></p>
                        <hr />
                        <div class="blogerinfo-contact">
                            <a target="_blank" title="QQ交流" href="<?php echo $myData['qq_link']; ?>"><i class="fa fa-qq fa-2x"></i></a>
                            <a target="_blank" title="给我写信" href="<?php echo $myData['email_link']; ?>"><i class="fa fa-envelope fa-2x"></i></a>
                            <a target="_blank" title="新浪微博" href="<?php echo $myData['sina_link']; ?>"><i class="fa fa-weibo fa-2x"></i></a>
                            <a target="_blank" title="码云" href="<?php echo $myData['git_link']; ?>"><i class="fa fa-git fa-2x"></i></a>
                        </div>
                    </div>
                    <!-- 天气 -->
                    <div class="blogerinfo shadow weather">
                        <div class="weather-top">
                            <p class="weather-city"><i class="fa fa-location-arrow"></i>&nbsp;你所在的位置：<?php echo $weather->city; ?></p>
                            <p class="weather-time"><?php echo date('H:i', strtotime($weather->updatetime));?>更新(<?php echo $weather->week; ?>)</p>
                        </div>
                        <div class="weather-info">
                            <p class="">
                                <img width="100" src="__index__/weather/<?php echo $weather->img; ?>.png">
                            </p>
                        </div>
                        <div class="weather-info2">
                            <div class="weather-info2-left" style="">
                                <div><p class="weather-sheShiDu"><?php echo $weather->temp; ?></div><div class="du">℃</div>
                            </div>
                            <div class="weather-info2-right" style="">
                                <div> <?php echo $weather->weather; ?> </div>
                                <div><?php echo $weather->winddirect; ?> - <?php echo $weather->windpower; ?></div>
                                <div><?php echo $weather->templow; ?>℃ ~ <?php echo $weather->temphigh; ?>℃</div>
                            </div>
                        </div>
                        <div class="weather-info3">
                            <div class="weather-info3-index" style="">
                                <!--<div> 穿衣： 炎热</div>-->
                                <!--<div> 运动： 较不宜</div>-->
                                <!--<div> 紫外线： 中等</div>-->
                                <!--<div> 感冒： 少发</div>-->
                                <!--<div> 洗车： 不宜</div>-->
                                <!--<div> 空气： 良</div>-->
                                <?php foreach($weather->index as $v): if(!preg_match('/空调/',$v->iname)): if(preg_match('/污染扩散指数/',$v->iname)): ?>
                                        <div><div class="weather-detail" hidden><?php echo $v->detail; ?></div> <?php echo str_replace('污染扩散指数','',$v->iname);?>： <?php echo $v->ivalue; ?></div>
                                        <?php else: ?>
                                        <div><div class="weather-detail" hidden><?php echo $v->detail; ?></div> <?php echo str_replace('指数','',$v->iname);?>： <?php echo $v->ivalue; ?></div>
                                        <?php endif; endif; endforeach; ?>
                            </div>
                        </div>
                        <hr style="height:0px" />
                        <div class="blogerinfo-contact"></div>
                    </div>

                    <div></div><!--占位-->

                    <div class="blog-module shadow">
                        <div class="blog-module-title">热文排行</div>
                        <ul class="fa-ul blog-module-ul">
                            <?php foreach($sideData['articleHot'] as $value): ?>
                            <li><i class="fa-li fa fa-hand-o-right"></i><a href="detail/<?php echo $value['id']; ?>.html"><?php echo $value['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="blog-module shadow">
                        <div class="blog-module-title">最近分享</div>
                        <ul class="fa-ul blog-module-ul">
                            <?php foreach($sideData['resources'] as $value): ?>
                            <li><i class="fa-li fa fa-hand-o-right"></i><a href="<?php echo $value['link']; ?>" target="_blank"><?php echo $value['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="blog-module shadow">
                        <div class="blog-module-title">友情链接</div>
                        <ul class="blogroll">
                            <?php foreach($sideData['link'] as $value): ?>
                            <li><a target="_blank" href="<?php echo $value['link_url']; ?>" title="Layui"><?php echo $value['link_name']; ?></a></li>
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
        <li class="layui-nav-item layui-this">
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
    <!-- 全局脚本 -->
    <script src="__index__/js/global.js"></script>
    <script src="__index__/js/scrollPage.js"></script>
    <!-- 本页脚本 -->
    <script src="__index__/js/home.js"></script>
    <!-- 天气脚本 -->
    <script src="__index__/js/weather.js"></script>
</body>
</html>