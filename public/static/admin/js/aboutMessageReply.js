layui.define(['laypage', 'layer', 'form', 'pagesize'], function (exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form();
    initilData();
    //页数据初始化
    function initilData() {
        var loading = layer.load(1);
        $.ajax({
            type: "POST",
            url: "/getMessageReplyApi.html",
            data: {id: $('#id').val()},
            success: function (data) {
                //数据加载
                layer.close(loading);
                var html = '';
                html += '<table style="" class="layui-table" lay-even>';
                html += '<colgroup><col width="150"><col width="200"><col><col width="100"><col width="50"></colgroup>';
                html += '<thead><tr><th>回复时间</th><th>回复人</th><th>回复内容</th><th>操作</th></tr></thead>';
                html += '<tbody>';
                if (data == '') {

                    html += '</tbody>';
                    html += '</table>';
                    html += '<center>暂无人回复</center>';
                } else {

                    //遍历文章集合
                    $.each(data, function (index, item) {
                        html += "<tr>";
                        html += "<td>" + item.time + "</td>";
                        html += "<td>" + item.name + "</td>";
                        html += "<td>" + item.content + "</td>";
                        html += '<td><button class="layui-btn layui-btn-small layui-btn-danger" onclick="layui.aboutMessage.deleteData(\'' + item.id + '\')"><i class="layui-icon">&#xe640;</i></button></td>';
                        html += "</tr>";

                    });
                    html += '</tbody>';
                    html += '</table>';

                }

                $('#dataContent').html(html);

                form.render('checkbox');  //重新渲染CheckBox，编辑和添加的时候
                $('#dataConsole,#dataList').attr('style', 'display:block'); //显示FiledBox

            }
        });

    }

    //输出接口，主要是两个函数，一个删除一个查看回复
    var aboutMessage = {
        deleteData: function (id) {
            layer.confirm('确定删除？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                var loading = layer.load(2);
                $.ajax({
                    type: 'POST',
                    url: '/deleteMessageReplyApi/' + id + '.html',
                    success: function (res) {
                        layer.close(loading);
                        if (true == res) {
                            location.reload();
                        } else {
                            layer.msg('删除失败', {icon: 5});
                        }
                    }
                });
            }, function () {

            });
        },
        showData: function (id) {
            var index = layer.load(1);
            setTimeout(function () {
                layer.close(index);
                parent.layer.open({
                    type: 2,
                    area: ['700px', '450px'],
                    fixed: false, //不固定
                    maxmin: true,
                    scrollbar: false,
                    content: '/aboutMessageReply/' + id + '.html'
                });
            }, 200);
        }
    };


    exports('aboutMessage', aboutMessage);
});