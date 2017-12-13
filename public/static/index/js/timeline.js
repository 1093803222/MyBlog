/**
 * Created by Xinlei on 2017/8/10.
 */


layui.use(['jquery', 'layedit', 'layer'], function () {
    var $ = layui.jquery;
    var ue;

    if ($('.timeline-cache').data('timeline')) {
        $('.timeline-box').append($('.timeline-cache').data('timeline'));
    } else {
        $.ajax({
            type: 'GET',
            url: 'getTimelineApi.html',
            success: function (data) {
                $('.timeline-box').append(data);
                $('.timeline-cache').data('timeline', data);
            }
        });
    }
    //年月份缩放
    function zoom() {
        setTimeout(function () {
            $('.monthToggle').click(function () {
                $(this).parent('h3').siblings('ul').slideToggle('slow');
                $(this).siblings('i').toggleClass('fa-caret-down fa-caret-right');
            });
            $('.yearToggle').click(function () {
                $(this).parent('h2').siblings('.timeline-month').slideToggle('slow');
                $(this).siblings('i').toggleClass('fa-caret-down fa-caret-right');
            });
        }, 1000);
    }
    zoom();
    //子栏目切换
    $('.child-nav-btn').on('click', function () {
        //清除选中状态
        $('.child-nav-btn').removeClass('child-nav-btn-this');
        //重新给予选中
        $(this).addClass('child-nav-btn-this');
        //清除原有内容，生成新内容
        $('.timeline-main').remove();
        if ($(this).attr('typeName') == 'timeline') {
            $('.timeline-box').append($('.timeline-cache').data('timeline'));
            zoom();
        }
        if ($(this).attr('typeName') == 'note') {

            var html = '<div class="timeline-main">\
                <h1><i class="fa fa-clock-o"></i>时光轴<span> —— 编写生活笔记</span></h1>\
                <textarea id="editor" class="content-textarea"></textarea>\
                <button class="layui-btn layui-btn-big faBiao">发表生活笔记</button>\
                </div>';
            $('.timeline-box').html(html);
            if (!$('.timeline-cache').data('note')) {
                //构建一个默认的编辑器
                ue = UE.getEditor('editor', {
                    autoHeightEnabled: true,
                    autoFloatEnabled: true,
                    zIndex: 1,
                    toolbars: [
                        [
                            'emotion', //表情
                            'undo', //撤销
                            'redo', //重做
                            'bold', //加粗
                            'time', //时间
                            'date', //日期
                            'fontfamily', //字体
                            'link', //超链接
                            'spechars', //特殊字符
                            'forecolor', //字体颜色
                            'lineheight', //行间距
                            'music', //音乐
                        ]
                    ],
                    elementPathEnabled: false //元素路径
                });
                //获取节点内容，包括节点本身
                var edit = $('#editor').prop('outerHTML');
                //将编辑器存入缓存
                $('.timeline-cache').data('note', edit);
            } else {
                $('.content-textarea').css('display', 'none');
                $('.content-textarea').before($('.timeline-cache').data('note'));
            }

            console.log($('.timeline-cache').data('note'));

            //监听提交
            $('.faBiao').click(function () {
                var content = ue.getContent();
                $.ajax({
                    type: 'POST',
                    url: 'setTimelineApi.html',
                    data: {'content': content},
                    success: function (res) {
                        if (res != 0) {
                            layer.msg('发表成功', {icon: 6});
                            $('.timeline-cache').data('timeline', res);
                            ue.execCommand('cleardoc');
                        } else {
                            layer.msg('发表失败', {icon: 5});
                        }
                    }
                });
            });

        }

    });


});