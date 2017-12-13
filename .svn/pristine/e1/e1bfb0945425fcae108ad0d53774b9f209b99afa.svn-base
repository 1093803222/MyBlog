

layui.define(['layer', 'form','upload'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form();

    var loading;
    form.on('submit(editAboutLink)',function(){
        $.ajax({
            type: "POST",
            url: 'editAboutLinkApi.html',
            data: $('.update-link-about').serialize(),
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


    $('.add-submit').on('click',function(){
        var data = new FormData($('#add-link-form')[0]);
        $.ajax({
            type: "POST",
            url: 'addLinkApi.html',
            data:data,
            processData:false,  //不需要对数据进行处理
            cache:false,        //不缓存
            contentType:false,
            success:function(res){
                if(res.code != 200){
                    layer.msg(res.msg,{icon:5});
                }else{
                    layer.msg(res.msg,{icon:6});
                    $('.friendlink').append(res.data);
                }
            }

        });
    });
});