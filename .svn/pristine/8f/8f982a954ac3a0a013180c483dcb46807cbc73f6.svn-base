
layui.define(['element', 'layer', 'form'], function (exports) {
    var form = layui.form();
    var $ = layui.jquery;


    // 自定义验证
    form.verify({
        account: function (value) {
            if (value.length < 1) {
                return "账号不得为空";
            }
        },
        password: function (value) {
            if(value.length < 1){
                return "密码不得为空";
            }
        },
        verify: function (value) {
            if (value.length < 1) {
                return '请填写验证码';
            }
        },
    });
    //监听登陆提交
    form.on('submit(login)', function (data) {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            //登陆验证
            $.ajax({
                type    : "POST",
                url     : "admin-loginApi.html",
                data    : {
                    account : data.field.account,
                    password: data.field.password,
                    verify  : data.field.verify
                },
                success : function(res){
                    if(true == res){
                        layer.msg('登陆成功，正在跳转......',{icon:6});
                        setTimeout(function(){
                            location.href="admin-index.html";
                        },1000);

                    }else{
                        //登陆错误更新验证码
                        errorInfo(res,'验证码错误');
                        errorInfo(res,'账号或密码错误');
                    }
                },
            });
        }, 400);
        return false;
    });

    //登陆错误更新验证码
    function errorInfo(res,info){
        if(res == info){
            //更新验证码
            var verify_url = "captcha.html?" + Math.random();
            $('.verify_img').attr('src',verify_url);
            layer.msg(res,{icon:5});
        }
    }

    //检测键盘按下
    $('body').keydown(function (e) {
        if (e.keyCode == 13) {  //Enter键
            if ($('#layer-login').length <= 0) {
                login();
            } else {
                // $('button[lay-filter=login]').click();
            }
        }
    });


    $('.enter').on('click', login);

    function login() {

        var loginHtml = '';
        loginHtml += '<script src="//captcha.luosimao.com/static/js/api.js"></script>';
        loginHtml += '<form class="layui-form" action="">';
        loginHtml += '<div class="layui-form-item">';
        loginHtml += '<label class="layui-form-label">账号</label>';
        loginHtml += '<div class="layui-input-inline pm-login-input">';
        loginHtml += '<input type="text" name="account" lay-verify="account" placeholder="请输入账号" value="" autocomplete="off" class="layui-input">';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '<div class="layui-form-item">';
        loginHtml += '<label class="layui-form-label">密码</label>';
        loginHtml += '<div class="layui-input-inline pm-login-input">';
        loginHtml += '<input type="password" name="password" lay-verify="password" placeholder="请输入密码" value="" autocomplete="off" class="layui-input">';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '<div class="layui-form-item">';
        loginHtml += '<label class="layui-form-label">验证码</label>';
        loginHtml += '<div class="layui-input-inline pm-login-input">';
        loginHtml += '<input type="text" name="verify" lay-verify="verify" placeholder="输入验证码" value="" autocomplete="off" style="width:100px;height:50px;float:left" class="layui-input">';
        loginHtml += '<div><img src="captcha.html" class="verify_img" style="width:170px;height:50px;float:left;margin-left: 10px" alt="captcha" /></div>';
        loginHtml += '</div>';
        loginHtml += '</div>';
        loginHtml += '<div class="layui-form-item" style="margin-top:25px;margin-bottom:0;">';
        loginHtml += '<div class="layui-input-block">';
        loginHtml += ' <button class="layui-btn" style="width:230px;" lay-submit="" lay-filter="login">立即登录</button>';
        loginHtml += ' </div>';
        loginHtml += ' </div>';
        loginHtml += '</form>';

        //弹出登陆
        layer.open({
            id: 'layer-login',
            type: 1,
            title: false,
            shade: 0.4,
            shadeClose: true,
            area: ['480px', '270px'],
            closeBtn: 0,
            anim: 1,
            skin: 'pm-layer-login',
            content: loginHtml
        });

        //验证码重置
        $('.verify_img').click(function(){
            var verify_url = "captcha.html?" + Math.random();
            $(this).attr('src',verify_url);
        });

        layui.form().render('checkbox');
    }



    exports('index', {});
});

