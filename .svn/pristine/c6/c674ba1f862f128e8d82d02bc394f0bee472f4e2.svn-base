/**
 *
 * 上拉加载更多
 */
function scrollPage(pageSize, typeId = "%", keywords = "%") {

    var pageIndex = 1; //加载索引
    $(window).scroll(function () {
        //scrollTop为滚动条滚动的高度
        var scrollTop = $(this).scrollTop();
        //windowHeight为当前可视区域的高度
        var windowHeight = $(this).height();
        //scrollHeight为当前可视区域的高度加上滚动条滚动的高度
        var scrollHeight = $(document).height();
        //滚动条滚动到底部的条件为如下
        if ((scrollTop + windowHeight) + 1 >= scrollHeight) {
            setTimeout(function () {
                pageIndex++;
                $.ajax({
                    type: 'GET',
                    url: 'indexArticleList.html',
                    data: {
                        'pageSize': pageSize,
                        'pageIndex': pageIndex,
                        'type_id': typeId,
                        'keywords': keywords,
                    },
                    beforeSend: function () {
                        var src = $('.loading').html();
                        var loading = '<div class="article article-loading" style="border:0;padding:0;margin:0;text-align: center"><span style="color:#808080"><img style="height:30px;width:30px;" src="' + src + '"> 正在载入列表中... </span></div>';
                        $('.blog-main-left').append(loading);
                    },
                    success: function (data) {
                        $('.article-loading').css('display', 'none');
                        $('.article-end').css('display', 'none');
                        if (data != "") {
                            $('.blog-main-left').append(data);
                        } else {
                            $('.blog-main-left').append('<div class="article article-end" style="border:0;padding:0;margin:0;text-align: center"><span style="color:#808080"> 已经没有更多了 </span></div>');
                            $(window).unbind('scroll');
                            return false;
                        }

                    }
                });
            }, 500);
        }
    });

}

/**
 * 文章分类信息
 * @pageSize 每次刷新数量
 * @typeId 文章分类id
 */
function articleTypeListData(pageSize, typeId) {
    $.ajax({
        type: 'GET',
        url: 'indexArticleList.html',
        data: {
            'pageSize': pageSize,
            'type_id': typeId,
        },
        beforeSend: function () {
            //停止自动加载更多，避免无数据继续加载
            $(window).unbind('scroll');
            var src = $('.loading').html();
            $('.blog-main-left').append('<div class="article article-loading" style="border:0;padding:0;margin:0;text-align: center"><span style="color:#808080"><img style="height:30px;width:30px;" src="' + src + '"> 正在载入列表中... </span></div>');
        },
        success: function (data) {
            $('.article-loading').css('display', 'none');
            if (data != "") {
                $('.blog-main-left').append(data);
            } else {
                $('.blog-main-left').append('<div class="article article-end" style="border:0;padding:0;margin:0;text-align: center"><span style="color:#808080"> 已经没有更多了 </span></div>');
                $(window).off('scroll');
                return false;
            }
        }
    });
    //自动加载更多
    scrollPage(pageSize, typeId);
}

/**
 * 文章搜索
 */
function searchArticle(keywords, pageSize) {
    $.ajax({
        type: 'GET',
        url: 'indexArticleList.html',
        data: {
            'pageSize': pageSize,
            'keywords': keywords,
        },
        beforeSend: function () {
            //停止自动加载更多，避免无数据继续加载
            $(window).off('scroll');
            var src = $('.loading').html();
            $('.blog-main-left').append('<div class="article article-loading" style="border:0;padding:0;margin:0;text-align: center"><span style="color:#808080"><img style="height:30px;width:30px;" src="' + src + '"> 正在载入列表中... </span></div>');
        },
        success: function (data) {
            $('.article-loading').css('display', 'none');
            if (data != "") {
                $('.blog-main-left').append(data);
            } else {
                $('.blog-main-left').append('<div class="shadow" style="text-align:center;font-size:16px;padding:40px 15px;background:#fff;margin-bottom:15px;">未搜索到与【<span style="color: #FF5722;">' + keywords + '</span>】有关的文章，请稍后再试！</div>');
                $(window).off('scroll');
                return false;
            }
        }
    });
    //自动加载更多
    scrollPage(pageSize, '%', keywords);
}
