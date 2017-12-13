//@ sourceURL=article-add.js
layui.use(['form', 'upload', 'layer'], function () {
    var form = layui.form();
    var $ = layui.jquery;
    var layer = layui.layer;

    //监听添加提交
    form.on('submit(formAddResourceType)', function (data) {
        var index = layer.load(1);
        $.ajax({
            type: "POST",
            url: 'addResourceTypeApi.html',
            data: {
                "resource_type_name": data.field.resource_type_name
            },
            datatype: 'json',
            async: false,
            success: function (res) {
                layer.close(index);
                if (true == res) {
                    layer.msg('添加成功', {icon: 6});
                    setTimeout(function () {
                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                        parent.layer.close(index); //再执行关闭
                        parent.location.reload();
                    }, 700);
                } else {
                    layer.msg(res, {icon: 5});
                }
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