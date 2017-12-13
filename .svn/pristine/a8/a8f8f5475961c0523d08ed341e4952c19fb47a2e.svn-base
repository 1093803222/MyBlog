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
        var loading = layer.load(1);
        $.ajax({
            type: "POST",
            url : "/SQLbackupsApi",
            success: function (data) {
                //数据加载
                layer.close(loading);
                //计算总页数（一般由后台返回）
                pages = Math.ceil(data.length / pageSize);
                //模拟数据分页（实际上获取的数据已经经过分页）
                var skip = pageSize * (currentIndex - 1);
                var take = skip + Number(pageSize);
                data = data.slice(skip, take);
                //数据分页
                var html = '';
                html += '<table style="" class="layui-table" lay-even>';
                html += '<colgroup><col><col><col><col width=50"><col width=50"><col width="50"></colgroup>';
                html += '<thead><tr><th>名称</th><th>大小</th><th>时间</th><th colspan="3">操作</th></tr></thead>';
                html += '<tbody>';
                //遍历文章集合
                $.each(data, function (index, item) {
                    html += "<tr>";
                    html += "<td>" + item.name + "</td>";
                    html += "<td>" + item.size + "</td>";
                    html += "<td>" + item.time + "</td>";
                    html += '<td><button title="还原" class="layui-btn layui-btn-small layui-btn-warm" onclick="layui.articleType.restore(\'' + item.name + '\')"><i class="layui-icon">&#x1002;</i></button></td>';
                    html += '<td><button title="下载" class="layui-btn layui-btn-small layui-btn-normal" onclick="layui.articleType.dowonload(\'' + item.name + '\')"><i class="layui-icon">&#xe601;</i></button></td>';
                    html += '<td><button title="删除" class="layui-btn layui-btn-small layui-btn-danger" onclick="layui.articleType.del(\'' + item.name + '\')"><i class="layui-icon">&#xe640;</i></button></td>';
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

    //添加备份
    $('#article-type-add').click(function () {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            var tp = $('#article-type-add').attr('is');
            ajaxBackup(tp);
        }, 200);
    });
    function ajaxBackup(tp, name = ''){
        $.ajax({
            type: 'POST',
            url : '/SQLbackupsApi',
            data: {tp: tp, name: name},
            success: function(data){
                layer.msg(data, {icon:6});
                setTimeout(function(){
                    location.reload();
                },1000);
            },
            error: function(res){
                layer.msg('失败，请重试', {icon:5});
            }
        });
    }
    //输出接口，主要是两个函数，一个删除一个编辑
    var articleType = {
        del: function (name) {
            layer.confirm('确定删除？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                var loading = layer.load(2);
                ajaxBackup('del', name);
            }, function () {

            });
        },
        restore: function (name) {
            // layer.msg('编辑Id为【' + id + '】的数据');
            var index = layer.load(1);
            setTimeout(function () {
                layer.close(index);
                ajaxBackup('restore', name);
            }, 200);
        },
        dowonload: function (name) {
            // layer.msg('编辑Id为【' + id + '】的数据');
            var index = layer.load(1);
            setTimeout(function () {
                layer.close(index);
                location.href='/SQLbackupsApi?tp=dowonload&name=' + name;
            }, 200);
        }
    };


    exports('articleType', articleType);
});