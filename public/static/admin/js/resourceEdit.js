//@ sourceURL=article-add.js
layui.use(['upload', 'form', 'layer'], function () {
    var form = layui.form();
    var $ = layui.jquery;
    var layer = layui.layer;
    var resourceId = $('#resourceId').val();
    var editCoverUrl = $('#editCoverUrl').val();
    var editResourceUrl = $('#editResourceUrl').val();
    //上传图片
    var uploadLoading = '';
    layui.upload({
        url: editCoverUrl, //上传接口
        before: function (input) {
            uploadLoading = layer.load(0);
            var data = {'id': resourceId};
            extra_data(input, data);
        }
        , success: function (res) { //上传成功后的回调\
            layer.close(uploadLoading);
            if (200 == res.code) {
                layer.msg(res.msg, {icon: 6});
                //设置封面显示
                $('#resourceCoverImg').attr('src', res.data.src);
                $('#resourceCoverSrc').attr('value', res.data.src);
            } else {
                layer.msg(res.msg, {icon: 5});
            }
        }
    });

    //上传扩展，带参数上传
    function extra_data(input, data) {
        var item = [];
        $.each(data, function (k, v) {
            item.push('<input type="hidden" name="' + k + '" value="' + v + '">');
        })
        $(input).after(item.join(''));
    }

    //监听文章发布提交
    form.on('submit(formEditResource)', function (data) {
        var loading = layer.load(1);
        $.ajax({
            type: "POST",
            contentType: 'application/json',
            url: editResourceUrl,
            data: JSON.stringify(data.field),
            datatype: 'json',
            async: false,
            success: function (res) {
                layer.close(loading);
                if (true == res) {
                    layer.msg('修改成功', {icon: 6});
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