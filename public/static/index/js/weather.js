
layui.use(['layer'],function(){
    var $ = layui.jquery,
        layer = layui.layer;

    $('.weather-info3-index div').hover(function(){
        layer.tips($(this).find("[class='weather-detail']").html(), this,  {
            tips: [1, '#3595CC'],
        });
    });

});
