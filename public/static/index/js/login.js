/*

 @Name：不落阁整站模板源码
 @Author：Absolutely
 @Site：http://www.lyblogs.cn

 */
layui.use(['form', 'layer'], function () {
    var form = layui.form();
    var layer = layui.layer;
    var $ = layui.jquery;



    $('.layui-layer-iframe', parent.document).animate({
        'top': '35%',
        'width': '370px',
        'height': '40%'
    },100);
    //监听点击新浪微博第三方登陆
    $('.weibo').click(function () {
        $('.layui-layer-iframe', parent.document).animate({
            'top': '0%',
            'left': '0%',
            'width': '100%',
            'height': '100%'
        }, 100);
        $('.layui-layer-iframe iframe', parent.document).animate({
            'height': '700px'
        }, 200);
        setTimeout(function () {
            location.href = $('#sina-codeUrl').val() + '&login_type=sina';
        },300);
    });
    //监听点击腾讯QQ第三方登陆
    $('.qq').click(function () {
        $('.layui-layer-iframe', parent.document).animate({
            'top': '0%',
            'left': '0%',
            'width': '100%',
            'height': '100%'
        }, 100);
        $('.layui-layer-iframe iframe', parent.document).animate({
            'height': '700px'
        }, 200);
        setTimeout(function () {
            // console.log($('#qq-codeUrl').val() + '&connect_type=qq');
            location.href = $('#qq-codeUrl').val() + '&login_type=qq';
        },300);
    });

});