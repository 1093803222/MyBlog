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
    function initilData(currentIndex, pageSize) {
        var index = layer.load(1);
        //模拟数据
        $.ajax({
            type: "POST",
            url: 'articleRecycleListApi.html',
            data: {
                currentIndex: currentIndex,
                pageSize: pageSize
            },
            success: function (data) {
                setTimeout(function () {
                    layer.close(index);
                    var pages = data.pages;  //总页数
                    delete data.pages;

                    var html = '';  //由于静态页面，所以只能作字符串拼接，实际使用一般是ajax请求服务器数据
                    html += '<table style="" class="layui-table" lay-even>';
                    html += '<colgroup><col width="180"><col><col width="150"><col width="180"><col width="90"><col width="50"><col width="50"></colgroup>';
                    html += '<thead><tr><th>发表时间</th><th>标题</th><th>发布人</th><th>类别</th><th colspan="2">操作</th></tr></thead>';
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

                        html += '<td><button class="layui-btn layui-btn-small layui-btn-normal" onclick="layui.article.editData(\'' + item.id + '\')"><i class="layui-icon">&#xe642;恢复文章</i></button></td>';
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
                }, 200);
            }
        });
    }

    //输出接口，主要是两个函数，一个删除一个编辑
    var article = {
        deleteData: function (id) {
            layer.confirm('确定删除？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                var index = layer.load(1);
                $.ajax({
                    type: 'POST',
                    url: 'deleteArticleRecycleApi.html',
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
            layer.confirm('是否要恢复这篇文章？', {
                btn: ['是', '否'] //按钮
            }, function () {
                var index = layer.load(1);
                $.ajax({
                    type: 'POST',
                    url: 'recoveryArticleRecycleApi.html',
                    data: {'id': id},
                    success: function (res) {
                        layer.close(index);
                        if (true == res) {
                            layer.msg('已经可以正常浏览这篇文章', {icon: 6});
                            location.reload();
                        } else {
                            layer.msg('恢复失败', {icon: 5});
                        }
                    }
                });
            }, function () {

            });
        }
    };


    exports('article', article);
});