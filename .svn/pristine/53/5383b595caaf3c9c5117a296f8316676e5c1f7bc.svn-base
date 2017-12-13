/*

 @Name：不落阁整站模板源码
 @Author：Absolutely
 @Site：http://www.lyblogs.cn

 */
layui.use(['form', 'layer'], function () {
    var form = layui.form();
    var layer = layui.layer;
    var $ = layui.jquery;

    var loading;
    $.ajax({
        type: "GET",
        url: 'qqLogin.html',
        data: {
            'code': $('#code').val(),
            'state': $('#state').val()
        },
        beforeSend: function () {
            loading = layer.load(2);
        },
        success: function (res) {
            layer.close(loading);
            var html;
            if (1 == res) {
                html = '<div class="icon">\
                    <h1><i class="layui-icon" style="font-size: 150px; font-weight:100; color:#00b7ee;">&#x1005;</i></h1>\
                    </div>\
                    <div class="message">\
                    <h1 style="font-size:40px;color:#808080;">授权成功啦，请等待！</h1>\
                    </div>';
                $('.box').append(html);

            } else {
                html = '<div class="icon">\
                    <h1><i class="layui-icon" style="font-size: 150px; font-weight:100; color:red;">&#xe650;</i></h1>\
                    </div>\
                    <div class="message">\
                    <h1 style="font-size:40px;color:#808080;">授权失败，点击<a href="javascript:;">跳转</a></h1>\
                    </div>';
                $('.box').append(html);
            }

            $('.box').append('<div class="time" style="font-size:20px;color:#808080;margin-left:10%">3秒后自动跳转.....</div>');
            var i = 2;
            var intervalid;
            intervalid = setInterval(fun, 1000);
            function fun() {
                if (i == 0) {
                    clearInterval(intervalid);
                    if(res ==  1){
                        //关闭本frame窗口
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                        parent.location.reload();
                    }else{
                        location.href="/login.html";
                    }
                }
                $('.time').remove();
                $('.box').append('<div class="time" style="font-size:20px;color:#808080;margin-left:10%">' + i + '秒后自动跳转.....</div>');
                i--;
            }

        }
    });

});