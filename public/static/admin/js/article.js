layui.define(['laypage', 'layer', 'form', 'pagesize'], function (exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage;
    var laypageId = 'pageNav';

    initilData(1, 8);
    //页数据初始化
    //currentIndex：当前也下标
    //pageSize：页容量（每页显示的条数）
    function initilData(currentIndex, pageSize, type_id = '%', keywords = '%') {
        var index = layer.load(1);
        //模拟数据
        $.ajax({
            type: "POST",
            url: 'articleListApi.html',
            data: {
                currentIndex: currentIndex,
                pageSize: pageSize,
                type_id : type_id,
                keywords: keywords
            },
            success: function (data) {

                setTimeout(function () {
                    layer.close(index);
                    var pages = data.pages;  //总页数
                    delete data.pages;

                    var html = '';  //由于静态页面，所以只能作字符串拼接，实际使用一般是ajax请求服务器数据
                    html += '<table style="" class="layui-table" lay-even>';
                    html += '<colgroup><col width="180"><col><col width="150"><col width="180"><col width="90"><col width="90"><col width="50"><col width="50"></colgroup>';
                    html += '<thead><tr><th>发表时间</th><th>标题</th><th>发布人</th><th>类别</th><th colspan="2">选项</th><th colspan="2">操作</th></tr></thead>';
                    html += '<tbody>';

                    //遍历文章集合
                    $.each(data, function (key, item) {
                        html += "<tr>";
                        html += "<td>" + item.edit_time + "</td>";
                        if (item.title.length > 10) {
                            html += "<td>" + item.title.substr(0, 10) + '......' + "</td>";
                        } else {
                            html += "<td>" + item.title + "</td>";
                        }
                        html += "<td>" + item.user_name + "</td>";
                        html += "<td>" + item.article_type_name + "</td>";
                        if (item.top == 1) {
                            html += '<td><form class="layui-form" action=""><div class="layui-form-item" style="margin:0;"><input type="checkbox" name="top" title="置顶" value="' + item.id + '" lay-filter="top" checked /></div></form></td>';
                        } else {
                            html += '<td><form class="layui-form" action=""><div class="layui-form-item" style="margin:0;"><input type="checkbox" name="top" title="置顶" value="' + item.id + '" lay-filter="top" /></div></form></td>';
                        }
                        if (item.recommend == 1) {
                            html += '<td><form class="layui-form" action=""><div class="layui-form-item" style="margin:0;"><input type="checkbox" name="top" title="推荐" value="' + item.id + '" lay-filter="recommend" checked /></div></form></td>';
                        } else {
                            html += '<td><form class="layui-form" action=""><div class="layui-form-item" style="margin:0;"><input type="checkbox" name="top" title="推荐" value="' + item.id + '" lay-filter="recommend" /></div></form></td>';
                        }




                        html += '<td><button class="layui-btn layui-btn-small layui-btn-normal" onclick="layui.article.editData(\'' + item.id + '\')"><i class="layui-icon">&#xe642;</i></button></td>';
                        html += '<td><button class="layui-btn layui-btn-small layui-btn-danger" onclick="layui.article.deleteData(\'' + item.id + '\')"><i class="layui-icon">&#xe640;</i></button></td>';
                        html += "</tr>";
                    });

                    html += '</tbody>';
                    html += '</table>';
                    html += '<div id="' + laypageId + '"></div>';

                    $('#dataContent').html(html);

                    form.render('checkbox');  //重新渲染CheckBox，编辑和添加的时候
                    $('#dataConsole,#dataList').attr('style', 'display:block'); //显示FiledBox

                    laypage({
                        cont: laypageId,
                        pages: pages,
                        groups: 8,
                        skip: true,
                        curr: currentIndex,
                        jump: function (obj, first) {
                            var currentIndex = obj.curr;
                            if (!first) {
                                initilData(currentIndex, pageSize, type_id, keywords);
                            }
                        }
                    });
                    //该模块是我定义的拓展laypage，增加设置页容量功能
                    //laypageId:laypage对象的id同laypage({})里面的cont属性
                    //pagesize当前页容量，用于显示当前页容量
                    //callback用于设置pagesize确定按钮点击时的回掉函数，返回新的页容量
                    layui.pagesize(laypageId, pageSize).callback(function (newPageSize) {
                        //这里不能传当前页，因为改变页容量后，当前页很可能没有数据
                        initilData(1, newPageSize, type_id, keywords);
                    });
                }, 200);
            }
        });
    }

    //监听分类select
    form.on('select(type)', function(data){
        initilData(1, 8, data.value);
    });

    //监听搜索按钮
    $('.layui-btn').on('click', function(){
        var keywords = $('input[name=keywords]').val();
        var type_id = $('select[name=type]').val();
        initilData(1, 8, type_id, keywords);
    });

    //监听置顶CheckBox
    form.on('checkbox(top)', function (data) {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            layer.msg('操作成功');
            $.ajax({
                type: "POST",
                url: "setArticleChecked.html",
                data: {
                    'id': data.value,
                    'top': data.elem.checked
                },
                success: function (res) {
                    data.elem.checked = res == 1 ? true : false;
                    form.render(); //重新渲染页面
                }
            });
        }, 300);
    });

    //监听推荐CheckBox
    form.on('checkbox(recommend)', function (data) {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            layer.msg('操作成功');
            $.ajax({
                type: "POST",
                url: "setArticleChecked.html",
                data: {
                    'id': data.value,
                    'recommend': data.elem.checked
                },
                success: function (res) {
                    data.elem.checked = res == 1 ? true : false;
                    form.render(); //重新渲染页面
                }
            });
        }, 300);
    });
    //发布文章
    $('#addArticle').click(function () {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            layer.open({
                type: 2,
                title: '发表文章',
                shadeClose: true,
                shade: 0.1,
                maxmin: true, //开启最大化最小化按钮
                area: ['70%', '600px'],
                content: 'addArticle.html',
                closeBtn: 1, //显示关闭按钮
                cancel: function () {
                    //点击关闭按钮前回调
                    var formData = layer.getChildFrame('body');
                    //获取上传的图片路径
                    var cover = formData.find('.layui-form').find('#articleCoverSrc').val();
                    if ('' != cover) {
                        $.ajax({
                            type: "POST",
                            url: "closeIframeArticle.html",
                            data: {
                                cover: cover
                            },
                            success: function (res) {
                                // layer.msg(res);
                            }
                        });
                    }

                },
            });
        }, 200);

    });

    //输出接口，主要是两个函数，一个删除一个编辑
    var article = {
        deleteData: function (id) {
            layer.confirm('确定删除？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                var index = layer.load(1);
                $.ajax({
                    type: 'POST',
                    url: 'deleteArticleApi.html',
                    data: {'id': id},
                    success: function (res) {
                        layer.close(index);
                        if (true == res) {
                            layer.msg('文章删除成功', {icon: 6});
                            location.reload();
                        } else {
                            layer.msg('文章删除失败', {icon: 5});
                        }
                    }
                });
            }, function () {

            });
        },
        editData: function (id) {
            // layer.msg('编辑Id为【' + id + '】的数据');
            var index = layer.load(1);
            setTimeout(function () {
                layer.close(index);
                layer.open({
                    type: 2,
                    title: '编辑文章',
                    shadeClose: true,
                    shade: 0.1,
                    area: ['1000px', '90%'],
                    content: 'editArticle/' + id + '.html', //iframe的url
                    cancel: function () {
                        //点击关闭按钮前回调
                        var formData = layer.getChildFrame('body');
                        //获取上传的图片路径
                        var cover = formData.find('.layui-form').find('#articleCoverSrc').val();
                        if ('' != cover) {
                            $.ajax({
                                type: "POST",
                                url: "closeIframeArticle.html",
                                data: {
                                    cover: cover
                                },
                                success: function (res) {
                                    // layer.msg(res);
                                }
                            });
                        }

                    },
                });
            }, 200);
        }
    };


    exports('article', article);
});