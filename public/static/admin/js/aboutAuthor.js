

layui.define(['layer', 'form','upload'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form();
    //上传图片
    var loading = '';
    layui.upload({
        url: 'uploadImgApi.html',
        before:function(){
            loading = layer.load(0);
        },
        success: function(res){
            layer.close(loading);
            if(res.code == 200 ){
                layer.msg(res.msg,{icon:6});
                $('.top_img').attr('src',res.data.src);
            }else{
                layer.msg(res.msg,{icon:5});
            }
        }
    });

    form.on('submit(editAboutAuthor)',function(){
        $.ajax({
            type: "POST",
            url: 'editAboutAuthorApi.html',
            data: $('.layui-form-pane').serialize(),
            datatype: 'json',
            async: false,
            before:function(){
                loading = layer.load(0);
            },
            success: function (res) {
                layer.close(loading);
                if(true == res){
                    layer.msg('更新成功',{icon:6});
                }else{
                    layer.msg(res,{icon:5});
                }
            },
            error: function (e) {
                layer.close(index);
                layer.msg(e.responseText);
            }
        });
    });

});