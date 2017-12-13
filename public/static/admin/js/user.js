layui.define(['laypage', 'layer', 'form', 'pagesize'], function (exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage;
    var laypageId = 'pageNav';

    initilData(1, 3);
    //页数据初始化
    //currentIndex：当前也下标
    //pageSize：页容量（每页显示的条数）
    function initilData(currentIndex, pageSize) {
        var loading = layer.load(2);
        $.ajax({
            type: 'POST',
            url: 'userListApi.html',
            data: {
                currentIndex: currentIndex,
                pageSize: pageSize,
            },
            success: function (data) {
                layer.close(loading);
                var pages = data.pages; //总页数
                delete data.pages;
                var html = '';
                html += '<table style="" class="layui-table" lay-even>';
                html += '<colgroup><col width=""><col><col width=""><col width=""><col width=""><col width="90"><col width="50"><col width="50"></colgroup>';
                html += '<thead><tr><th>用户名</th><th>昵称</th><th>最后登陆时间</th><th>最后登陆ip</th><th>黑名单</th><th colspan="2">操作</th></tr></thead>';
                html += '<tbody>';
                $.each(data, function (key, item) {
                    if (item == undefined) {
                        return true;
                    }
                    html += "<tr>";
                    html += "<td>" + item.account + "</td>";
                    html += "<td>" + item.name + "</td>";
                    html += "<td>" + item.login_time + "</td>";
                    html += "<td>" + item.login_ip + "</td>";

                    if (item.blacklist == 1) {
                        html += '<td><form class="layui-form" action=""><div class="layui-form-item" style="margin:0;"><input type="checkbox" name="top" title="ON" value="' + item.id + '" lay-filter="top" checked /></div></form></td>';
                    } else {
                        html += '<td><form class="layui-form" action=""><div class="layui-form-item" style="margin:0;"><input type="checkbox" name="top" title="ON" value="' + item.id + '" lay-filter="top"  /></div></form></td>';
                    }

                    html += '<td><button class="layui-btn layui-btn-small layui-btn-normal" onclick="layui.user.editUser(\'' + item.id + '\')"><i class="layui-icon">&#xe642;</i></button></td>';
                    html += '<td><button class="layui-btn layui-btn-small layui-btn-danger" onclick="layui.user.deleteData(\'' + item.id + '\')"><i class="layui-icon">&#xe640;</i></button></td>';
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

    //监听黑名单CheckBox
    form.on('checkbox(top)', function (data) {
        var index = layer.load(1);
        setTimeout(function () {
            layer.close(index);
            if (data.value != 1) {
                if (!data.elem.checked) {
                    layer.msg('已取消黑名单');
                    $.post('setBlackListApi.html', {blacklist: 0, id: data.value}, function () {
                        data.elem.checked = false;
                    });
                }
                else {
                    layer.msg('已加入黑名单');
                    $.post('setBlackListApi.html', {blacklist: 1, id: data.value}, function () {
                        data.elem.checked = true;
                    });
                }
            }else{
                layer.msg('主账号不能设置黑名单');
                data.elem.checked = false;
            }
            form.render();  //重新渲染
        }, 100);
    });


    //添加用户
    $('#addUser').click(function () {

        layer.open({
            type: 2,
            title: '添加用户',
            shadeClose: true,
            shade: 0.1,
            area: ['450px', '500px'],
            content: 'addUserPage.html' //iframe的url
        });

    });
    //输出接口，主要是两个函数，一个删除一个编辑
    var user = {
        deleteData: function (id) {
            layer.confirm('确定删除？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('deleteUserApi.html', {id: id}, function (res) {
                    if (res == true) {
                        layer.msg('删除成功');
                        location.reload();
                    } else {
                        layer.msg(res);
                    }

                });

            }, function () {

            });
        },
        editUser: function (id) {
            // layer.msg('编辑Id为【' + id + '】的数据');
            layer.open({
                type: 2,
                title: '编辑用户',
                shadeClose: true,
                shade: 0.1,
                area: ['450px', '500px'],
                content: 'editUserPage/' + id + '.html' //iframe的url
            });
        }
    };


    exports('user', user);
});