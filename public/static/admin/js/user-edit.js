//@ sourceURL=user-edit.js
layui.use(['form', 'layer'], function () {
    var form = layui.form();
    var $ = layui.jquery;
    var layer = layui.layer;


    //监听添加提交
    form.on('submit(formEditUser)', function (data) {

        $.ajax({
            type: "POST",
            contentType: 'application/json',
            url: $('#editUserApi').val(),
            data: JSON.stringify(data.field),
            datatype: 'json',
            async: false,
            success: function (res) {
                if(true != res){
                    layer.msg(res, {icon: 2});
                    return false;
                }
                layer.msg('修改成功', {icon: 1});
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