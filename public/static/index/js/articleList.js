/**
 * Created by Xinlei on 2017/8/7.
 */
$(function () {

    //加载页面内容
    $.ajax({
        type: 'GET',
        url: 'indexArticleList.html',
        success: function (data) {
            $('.blog-main-left').append(data);
        }
    });
    //上拉加载更多
    scrollPage(10);

    $('.article-category a').on('click', function () {
        var typeId = $(this).attr('typeId');
        var typeName = $(this).attr('typeName');
        $('.typeTag').html(typeName);
        $('.blog-main-left').html(null);    //清空原内容
        //根据分类获取文章列表数据
        articleTypeListData(10, typeId);
    });

    //关键字搜索
    $('.search-btn').on('click', function () {
        var keywords = $('input[name=keywords]').val();
        if(keywords == ''){
            layui.use('layer',function(){
                layer.msg('请填写搜索的内容',{icon:5});
            });
            return false;
        }
        //过滤输入标签
        keywords = toTxt(keywords);
        $('.typeTag').html('搜索');
        $('.blog-main-left').html(null);    //清空原内容
        searchArticle(keywords,10);
    });

    /*正则表达式 替换括号,尖括号等*/
    function toTxt(str) {
        var RexStr = /\<|\>|\"|\'|\&/g
        str = str.replace(RexStr, function(MatchStr) {
            switch (MatchStr) {
                case "<":
                    return "&lt;";
                    break;
                case ">":
                    return "&gt;";
                    break;
                case "\"":
                    return "&quot;";
                    break;
                case "'":
                    return "&#39;";
                    break;
                case "&":
                    return "&amp;";
                    break;
                default:
                    break;
            }
        })
        return str;
    }
});