/*

 @Name：不落阁整站模板源码
 @Author：Absolutely
 @Site：http://www.lyblogs.cn

 */

layui.use(['element', 'jquery', 'form', 'layedit'], function () {
    var element = layui.element();
    var form = layui.form();
    var $ = layui.jquery;
    var layedit = layui.layedit;


    //评论和留言的编辑器
    var editIndex = layedit.build('remarkEditor', {
        height: 150,
        tool: ['face', '|', 'left', 'center', 'right', '|', 'link'],
    });
    //评论和留言的编辑器的验证
    layui.form().verify({
        content: function (value) {
            value = $.trim(layedit.getText(editIndex));
            if (value == "") return "自少得有一个字吧";
            layedit.sync(editIndex);
        }
    });

    //Hash地址的定位
    var layid = location.hash.replace(/^#tabIndex=/, '');
    if (layid == "") {
        element.tabChange('tabAbout', 1);
    }
    element.tabChange('tabAbout', layid);

    element.on('tab(tabAbout)', function (elem) {
        location.hash = 'tabIndex=' + $(this).attr('lay-id');
    });

    //监听留言提交
    form.on('submit(formLeaveMessage)', function (data) {
        var index = layer.load(1);
        //留言提交
        setTimeout(function () {
            layer.close(index);
            var content = data.field.editorContent;
            $.ajax({
                type: "POST",
                url: '/remarkApi.html',
                data: {'content': content},
                success: function (res) {
                    if (false != res) {
                        var html = '<li><div class="comment-parent" remark-id="' + res.id + '"><img src="' + res.top + '"alt="' + res.name + '"/><div class="info"><span class="username">' + res.name + '</span></div><div class="content">' + content + '</div><p class="info info-footer"><span class="time">' + res.time + '</span><a class="btn-reply"href="javascript:;" onclick="btnReplyClick(this)">回复</a></p></div><!--回复表单默认隐藏--><div class="replycontainer layui-hide"><form class="layui-form"action=""><div class="layui-form-item"><textarea name="replyContent"lay-verify="replyContent"placeholder="请输入回复内容"class="layui-textarea"style="min-height:80px;"></textarea></div><div class="layui-form-item"><button class="layui-btn layui-btn-mini"lay-submit="formReply"lay-filter="formReply">提交</button></div></form></div></li>';
                        $('.blog-comment').prepend(html);
                        $('#remarkEditor').val('');
                        editIndex = layui.layedit.build('remarkEditor', {
                            height: 150,
                            tool: ['face', '|', 'left', 'center', 'right', '|', 'link'],
                        });
                        layer.msg("留言成功", {icon: 1});
                    } else {
                        layer.msg('还没有登陆不能留言噢~', {icon: 5});
                    }
                },
                error: function () {
                    layer.msg('内部服务器错误', {icon: 5});
                }
            });


        }, 500);
        return false;
    });

    //监听留言回复提交
    form.on('submit(formReply)', function (data) {
        var index = layer.load(1);
        //留言回复
        setTimeout(function () {
            layer.close(index);
            var id = $(data.form).parent('.replycontainer').siblings('.comment-parent').attr('remark-id');
            var content = data.field.replyContent;
            $.ajax({
                type: "POST",
                url: '/remarkApi.html',
                data: {'id': id, 'content': content},
                success: function (res) {
                    if (false != res) {
                        var html = '<div class="comment-child"><img src="' + res.top + '"alt="' + res.name + '"/><div class="info"><span class="username">' + res.name + '</span><span>' + content + '</span></div><p class="info"><span class="time">' + res.time + '</span></p></div>';
                        $(data.form).find('textarea').val('');
                        $(data.form).parent('.replycontainer').before(html).siblings('.comment-parent').children('p').children('a').click();
                        layer.msg("回复成功", {icon: 1});
                    } else {
                        layer.msg('还没有登陆不能留言噢~', {icon: 5});
                    }

                },
                error: function () {
                    layer.msg('内部服务器错误', {icon: 5});
                }
            });

        }, 500);
        return false;
    });

    //监听加载更多
    $('#click-reload').on("click", function () {
        var pageSize = $('.blog-comment li').size();
        clickReload(pageSize);
    });

    function clickReload(pageSize) {
        var src = $('.loading').html();
        $.ajax({
            type: 'POST',
            url: '/getRemarkPageApi.html',
            data: {
                'pageSize': pageSize
            },
            beforeSend: function () {
                $('#click-reload').html('<img style="height:30px;width:30px;" src="' + src + '">');
            },
            success: function (data) {
                if (data.parent != '') {
                    $('#click-reload').html('点击加载更多');
                } else {
                    $('#click-reload').remove();
                    $('.reload-div').html('亲，已经没有更多了');
                    return false;
                }
                var html = '';
                $.each(data.parent, function (key, value) {
                    var child_html = '';
                    $.each(data.child, function (key, value2) {
                        if (value.id == value2.pid) {
                            child_html += '<hr />\
                            <div class="comment-child">\
                                <img src="' + value2.top + '" alt="' + value2.name + '" />\
                                <div class="info">\
                                    <span class="username">' + value2.name + '</span><span>' + value2.content + '</span>\
                                </div>\
                                <p class="info"><span class="time">' + value2.time + '</span></p>\
                            </div>';
                        }
                    });
                    html += '<li style="display: none;">\
                 <div class="comment-parent"  remark-id="' + value.id + '">\
                    <img src="' + value.top + '" alt="' + value.name + '" />\
                    <div class="info">\
                        <span class="username">' + value.name + '</span>\
                    </div>\
                    <div class="content">\
                        ' + value.content + '\
                    </div>\
                <p class="info info-footer"><span class="time">' + value.time + '</span><a class="btn-reply" href="javascript:;" onclick="btnReplyClick(this)">回复</a></p>\
                </div>\
                ' + child_html + '\
                <div class="replycontainer layui-hide">\
                    <form class="layui-form" action="">\
                        <div class="layui-form-item">\
                            <textarea name="replyContent" lay-verify="replyContent" placeholder="请输入回复内容" class="layui-textarea" style="min-height:80px;"></textarea>\
                            </div>\
                            <div class="layui-form-item">\
                            <button class="layui-btn layui-btn-mini" lay-submit="formReply" lay-filter="formReply">提交</button>\
                            </div>\
                            </form>\
                            </div>\
                            </li>';

                });
                $('.blog-comment').append(html);
                $('.blog-comment li').slideDown("slow");

            }
        });
    }
});


function btnReplyClick(elem) {
    var $ = layui.jquery;
    $(elem).parent('p').parent('.comment-parent').siblings('.replycontainer').toggleClass('layui-hide');
    if ($(elem).text() == '回复') {
        $(elem).text('收起')
    } else {
        $(elem).text('回复')
    }
}
systemTime();

function systemTime() {
    //获取系统时间。
    var dateTime = new Date();
    var year = dateTime.getFullYear();
    var month = dateTime.getMonth() + 1;
    var day = dateTime.getDate();
    var hh = dateTime.getHours();
    var mm = dateTime.getMinutes();
    var ss = dateTime.getSeconds();

    //分秒时间是一位数字，在数字前补0。
    mm = extra(mm);
    ss = extra(ss);

    //将时间显示到ID为time的位置，时间格式形如：19:18:02
    document.getElementById("time").innerHTML = year + "-" + month + "-" + day + " " + hh + ":" + mm + ":" + ss;
    //每隔1000ms执行方法systemTime()。
    setTimeout("systemTime()", 1000);
}

//补位函数。
function extra(x) {
    //如果传入数字小于10，数字前补一位0。
    if (x < 10) {
        return "0" + x;
    }
    else {
        return x;
    }
}