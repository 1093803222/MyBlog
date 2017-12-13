$.ajax({
    type: 'GET',
    url: 'resourceApi.html',
    success: function (data) {
        resource_each(data);
    }
});

//监听分类切换
$('.child-nav-btn').on('click', function () {
    // 定义一个html储存变量
    var resourceHTML = '';

    var typeId = $(this).attr('typeid');
    //切换子栏目时，清空原内容
    $('.resource-main').html('');
    //清楚所有选中状态
    $('.child-nav-btn').removeClass('child-nav-btn-this');
    //重新给予选中状态
    $(this).addClass('child-nav-btn-this');
    if ($('.resource-main-cache').data('resource' + typeId) != undefined) {
        //取出缓存数据
        $('.resource-main').append($('.resource-main-cache').data('resource' + typeId));
    } else {
        $.ajax({
            type: 'GET',
            url: 'resourceApi.html',
            data: {'type_id': typeId},
            success: function (data) {
                resource_each(data);
                //取得资源内容列表
                resourceHTML = $('.resource-main').html();
                //存入缓存
                $('.resource-main-cache').data('resource' + typeId, resourceHTML);
            }
        });
    }


});

//监听列表中的标签点击链接
$('.typetag').on('click', function () {
    var typeId = $(this).attr('typeid');
    alert(typeId);
});

function resource_each(data) {
    var html = '';
    $.each(data, function (key, val) {
        html += '<div class="resource shadow">\
                <div class="resource-cover">\
                <img src="' + val.cover + '" alt="时光轴" />\
                </a>\
                </div>\
                <h1 class="resource-title" style="margin-bottom:0"><a href="' + val.link + '" target="_blank"  title="下载链接">' + val.title + '</a></h1>\
                <p class="resource-title" style="padding: 0;margin:0;font-size: 10px;color: #B2B2B2;">' + val.edit_time + '</p>\
                <p class="resource-abstract">' + val.desc + '</p>\
            <div class="resource-info">\
                <span class="category"><a onclick="typeTab(' + val.type_id + ')" class="typetag" href="javascript:;"><i class="fa fa-tags fa-fw"></i>&nbsp;' + val.resource_type_name + '</a></span>\
                <span class="author"><i class="fa fa-user fa-fw"></i>' + val.user_name + '</span>\
                <div class="clear"></div>\
                </div>\
                <div class="resource-footer">\
                <a class="layui-btn layui-btn-small layui-btn-primary" href="' + val.link + '" target="_blank" title="下载链接"><i class="fa fa-download fa-fw"></i>下载</a>\
                </div>\
                </div>';
    });
    html += '<div class="clear"></div>';
    $('.resource-main').append(html);
}


function typeTab(typeId) {
    // 定义一个html储存变量
    var resourceHTML = '';

    //切换子栏目时，清空原内容
    $('.resource-main').html('');
    //清楚所有选中状态
    $('.child-nav-btn').removeClass('child-nav-btn-this');
    //重新给予选中状态
    $(this).parent('resource-main').prev().addClass('child-nav-btn-this');
    if ($('.resource-main-cache').data('resource' + typeId) != undefined) {
        //取出缓存数据
        $('.resource-main').append($('.resource-main-cache').data('resource' + typeId));
    } else {
        $.ajax({
            type: 'GET',
            url: 'resourceApi.html',
            data: {'type_id': typeId},
            success: function (data) {
                resource_each(data);
                //取得资源内容列表
                resourceHTML = $('.resource-main').html();
                //存入缓存
                $('.resource-main-cache').data('resource' + typeId, resourceHTML);
            }
        });
    }
}
