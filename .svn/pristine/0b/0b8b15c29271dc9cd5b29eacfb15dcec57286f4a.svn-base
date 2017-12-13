//@ sourceURL=user-add.js
layui.use(['form', 'layer'], function () {
    var form = layui.form();
    var $ = layui.jquery;
    var layer = layui.layer;

    // 获取权限信息
    $.post('getPowerGroup.html',function(powerGroup){
        var optionHtml = '';
        $.each(powerGroup,function(index,power){
            optionHtml += "<option value='"+ power.id +"'>"+ power.power_name +"</option>";
        });

        $('#power_group').append(optionHtml);
        form.render();  //全局刷新
    })
    //监听添加提交
    form.on('submit(formAddUser)', function (data) {
        // //用户名验证
        // var reg = /^[a-zA-Z0-9]{5,16}/;
        // if (!reg.test(data.field.username)) {
        //     layer.msg('用户名未按要求填写', {icon: 2});
        //     return false;
        // }
        // //密码验证
        // if (!reg.test(data.field.password)) {
        //     layer.msg('密码未按要求填写', {icon: 2});
        //     return false;
        // }
        // //确认密码
        // if (data.field.isPassword != data.field.password) {
        //     layer.msg('确认密码不一致', {icon: 2});
        //     return false;
        // }
        // //昵称验证
        // var nameReg = /^.{1,10}$/;
        // if (!nameReg.test(data.field.name)) {
        //     layer.msg('昵称未按要求填写', {icon: 2});
        //     return false;
        // }

        $.ajax({
            type: "POST",
            contentType: 'application/json',
            url: 'addUserApi.html',
            data: JSON.stringify(data.field),
            datatype: 'json',
            async: false,
            success: function (res) {
                if(true != res){
                    layer.msg(res, {icon: 2});
                    return false;
                }
                layer.msg('注册成功', {icon: 1});
                setTimeout(function(){
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    parent.layer.close(index); //再执行关闭
                    parent.location.reload();
                },700);

            },
            error: function (e) {
                layer.close(index);
                layer.msg(e.responseText);
            }
        });
        return false;
    });
    form.render(); //更新全部
});