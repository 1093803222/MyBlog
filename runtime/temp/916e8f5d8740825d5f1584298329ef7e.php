<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"F:\halloword\xinleiBlog\public/../application/admin\view\show\_article\editArticle.html";i:1501512018;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑文章</title>
    <!-- layui.css  -->
    <link href="__public__/plugin/layui/css/layui.css" rel="stylesheet" />
    <link rel="shortcut icon" href="__public__/images/Logo_40.png" type="image/x-icon">
      <link href="__public__/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href="__public__/css/animate.min.css" rel="stylesheet">
    <link href="__public__/css/main.css" rel="stylesheet" />
    <!-- 百度编辑器 -->
    <script type="text/javascript" charset="utf-8" src="__public__/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="__public__/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="__public__/ueditor/lang/zh-cn/zh-cn.js"></script>

</head>
<body>
    <form class="layui-form form-main" action="">
        <input type="hidden" id="articleId" name="id" value="<?php echo $article['id']; ?>">
        <input type="hidden" id="editCoverUrl" value="<?php echo url('admin/api.Article/editArticleCoverApi'); ?>">
        <input type="hidden" id="editArticleUrl" value="<?php echo url('admin/api.Article/editArticleApi'); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" value="<?php echo $article['title']; ?>" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">摘要</label>
        <div class="layui-input-block">
            <input type="text" name="description" value="<?php echo $article['description']; ?>" lay-verify="required" placeholder="请输入摘要" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分类</label>
        <div class="layui-input-block">
            <select name="type_id" lay-verify="required">
                <option value=""></option>
                    <?php foreach($articleTypeAll as $type): if($article['type_id'] == $type['id']): ?>
                        <option selected value="<?php echo $type['id']; ?>"><?php echo $type['article_type_name']; ?></option>
                        <?php else: ?>
                        <option value="<?php echo $type['id']; ?>"><?php echo $type['article_type_name']; ?></option>
                        <?php endif; endforeach; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">内容</label>
        <div class="layui-input-block">
            <!--编辑器-->
            <textarea id="editor" name="content" style="width: 100%; height: 360px" placeholder="请输入内容" lay-verify="required" class="layui-textarea"><?php echo $article['content']; ?></textarea>

        </div>
    </div>
    <div class="layui-form-item" style="position:relative;">
        <input id="articleCoverSrc" name="cover_src" type="hidden" />
        <label class="layui-form-label">封面</label>
        <div class="layui-input-inline">
            <img id="articleCoverImg" class="img-cover" src="<?php echo $article['cover']; ?>" <?php if(is_file($article['cover'])): ?>alt='封面'<?php else: ?>alt='暂无封面'<?php endif; ?> />
        </div>
        <div class="layui-input-inline" style="position:absolute;bottom:0;">
            <input id="articleCoverInput" type="file" name="cover" class="layui-upload-file" lay-title="点击上传" lay-ext="jpg|png|bmp" lay-title="请上传一张图片吧亲" />
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选项</label>
        <div class="layui-input-block">
            <input type="checkbox" name="top" <?php if($article['top'] == 1): ?>checked<?php endif; ?> title="置顶">
            <input type="checkbox" name="recommend" <?php if($article['recommend'] == 1): ?>checked<?php endif; ?> title="推荐">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formAddArticle">立即提交</button>
        </div>
    </div>
</form>
    <script>
        //构建一个编辑器
        var ue = UE.getEditor('editor', {
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            zIndex:1
        });

    </script>
<script src="__public__/plugin/layui/layui.js"></script>
<script src="__public__/js/article-edit.js"></script>
</body>
</html>