﻿layui.define(['laypage', 'layer', 'form', 'pagesize'], function (exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage;
    var laypageId = 'pageNav';

    initilData(1, 8);
    //页数据初始化
    //currentIndex：当前也下标
    //pageSize：页容量（每页显示的条数）
    function initilData(currentIndex, pageSize) {
        var loading = layer.load(1);
        $.ajax({
            type: "POST",
            url: "articleTypeListApi.html",
            data: {
                currentIndex: currentIndex,
                pageSize: pageSize
            },
            success: function (data) {
                //数据加载
                layer.close(loading);
                var pages = data.pages;  //总页数
                delete data.pages;
                //数据分页
                var html = '';
                html += '<table style="" class="layui-table" lay-even>';
                html += '<colgroup><col width="180"><col><col width=50"><col width="50"></colgroup>';
                html += '<thead><tr><th>ID</th><th>标题</th><th colspan="2">操作</th></tr></thead>';
                html += '<tbody>';
                //遍历文章集合
                $.each(data, function (index, item) {
                    html += "<tr>";
                    html += "<td>" + item.id + "</td>";
                    html += "<td>" + item.article_type_name + "</td>";
                    html += '<td><button class="layui-btn layui-btn-small layui-btn-normal" onclick="layui.articleType.editData(\'' + item.id + '\')"><i class="layui-icon">&#xe642;</i></button></td>';
                    html += '<td><button class="layui-btn layui-btn-small layui-btn-danger" onclick="layui.articleType.deleteData(\'' + item.id + '\')"><i class="layui-icon">&#xe640;</i></button></td>';
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
                            initilData(currentIndex, pageSize);
                        }
                    }
                });
                //该模块是我定义的拓展laypage，增加设置页容量功能
                //laypageId:laypage对象的id同laypage({})里面的cont属性
                //pagesize当前页容量，用于显示当前页容量
                //callback用于设置pagesize确定按钮点击时的回掉函数，返回新的页容量
                layui.pagesize(laypageId, pageSize).callback(function (newPageSize) {
                    //这里不能传当前页，因为改变页容量后，当前页很可能没有数据
                    initilData(1, newPageSize);
                });
            }
        });

    }

    //添加文章分类
    $('#article-type-add').click(function () {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            layer.open({
                type: 2,
                title: '添加文章分类',
                shadeClose: true,
                shade: 0.1,
                area: ['500px', '200px'],
                content: 'addArticleType.html' //iframe的url
            });
        }, 200);
    });

    //输出接口，主要是两个函数，一个删除一个编辑
    var articleType = {
        deleteData: function (id) {
            layer.confirm('确定删除？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                var loading = layer.load(2);
                $.ajax({
                    type: 'GET',
                    url: 'articleTypeDeleteApi/' + id + '.html',
                    success: function (res) {
                        layer.close(loading);
                        if(true == res){
                            layer.msg('删除成功',{icon:6});
                            location.reload();
                        }else{
                            layer.msg('删除失败',{icon:5});
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
                    area: ['500px', '200px'],
                    content: 'editArticleType/' + id + '.html' //iframe的url
                });
            }, 200);
        }
    };


    exports('articleType', articleType);
});