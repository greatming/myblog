<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ajaxfileupload.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/underscore-min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/extensions/ueditor/ueditor.config.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/extensions/ueditor/ueditor.all.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/extensions/ueditor/lang/zh-cn/zh-cn.js"></script>
<ul class="nav nav-pills" role="tablist">
    <li role="presentation"><a href="<?php echo $this->createUrl("index/article");?>">文章管理</a></li>
    <li role="presentation" class="active"><a href="<?php echo $this->createUrl("index/addarticle");?>">添加文章</a></li>
</ul>
<div class="hr hr-18 dotted hr-double"></div>
<form class="form-horizontal" role="form">
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 标题 </label>

    <div class="col-sm-9">
        <input type="text" id="form-field-1" name="title" placeholder="标题" class="col-xs-10" />
    </div>
</div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 是否转发 </label>
        <div class="col-xs-3">
            <label>
                <input type="checkbox" class="ace ace-switch ace-switch-7" name="repost">
                <span class="lbl"></span>
            </label>
        </div>
    </div>


<div class="space-4"></div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-input-author"> 作者 </label>

    <div class="col-sm-9">
            <input type="text" class="col-sm-2" id="form-input-author" name="author" value="greatming" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 描述 </label>
    <div class="col-sm-9">
        <textarea class="form-control" id="description" name="description" placeholder="请输入描述"></textarea>
    </div>
</div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 缩略图 </label>
        <div class="col-sm-2">
            <input type="file" name="file" id="thumbnail" />
        </div>
        <div class="col-sm-1">
            <button type="button" id="upload_thumb" class="btn btn-white btn-success">Upload</button>
        </div>
    </div>
    <div class="form-group thumb_img hide">
        <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">  </label>
        <div class="col-xs-6 col-md-3">
            <button data-dismiss="alert" class="close" type="button">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <a href="javascript:void(0)" class="thumbnail">
                <img id="detail" src="" alt="">
            </a>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 标签 </label>
        <div class="col-sm-5 select_tag">

        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">  </label>
        <div class="col-sm-5 all_tag" style="border: 1px dotted;padding: 2px;">
            <?php foreach($tags_list as $tag){?>
                <span style="cursor: pointer; margin-bottom: 5px; display: inline-block"><span class="label label-xlg label-light arrowed arrowed-right tag_item"><?php echo $tag->name;?></span></span>
            <?php }?>

        </div>
    </div>
    <div id="" style="margin-left: 200px;">
        <script id="editor" type="text/plain" style="width:800px;height:400px;"></script>
    </div>




    <div class="space-24"></div>

    <div class="alert alert-danger art_error hide">
        <strong>
            <i class="ace-icon fa fa-times"></i>
            Error!
        </strong>
        <span id="error_info">
             Change a few things up and try submitting again.
        </span>

        <br>
    </div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="button" id="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Submit
        </button>

        &nbsp; &nbsp; &nbsp;
        <button class="btn" type="reset">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Reset
        </button>
    </div>
</div>

<div class="hr hr-24"></div>




</form>
<script>
    Array.prototype.in_array = function(item){
        for(var i = 0; i < this.length; i++){
            if(item == this[i]){
                return true;
                break;
            }
        }
        return false;
    }
    Array.prototype.remove = function(val) {
        var index = this.indexOf(val);
        if (index > -1) {
            this.splice(index, 1);
        }
    };
    var select_tags = [];

    var ue = UE.getEditor('editor');

    $("#upload_thumb").on("click",function(){
        upload_thumb();
    })

    var upload_thumb = function(){
        $.ajaxFileUpload
        (
            {
                url: '<?php echo $this->createUrl("/common/Upload");?>', //用于文件上传的服务器端请求地址
                secureuri: false,
                fileElementId: 'thumbnail',
                dataType: 'json', //返回值类型 一般设置为json
                success: function (data)  //服务器成功响应处理函数
                {
                    if(data.status == 1){
                        var img_data = JSON.parse(data.data);
                        img_obj = new Image();
                        img_obj.src = img_data.url;
                        img_obj.onload = function(){
                            $("#detail",".thumb_img").attr("src", img_obj.src);
                            $(".thumb_img").removeClass("hide");
                        }
                    }else{
                        alert(data.info);
                    }
                },
                error: function (data, status, e)
                {
                    alert(e);
                }
            }
        )
        return false;
    }
    $(".tag_item").on("click",function(){
        var tag_name = $(this).text();
        if(select_tags.length > 2 || select_tags.in_array(tag_name)){
            return false;
        }
        select_tags.push(tag_name);
        var html = '<span><span class="label label-xlg label-primary arrowed arrowed-right">'+tag_name+'</span><span  class="glyphicon glyphicon-remove mright del_tag" style="margin-right: 15px;"></span></span>';
        $(".select_tag").append(html);
    });

    $(".select_tag").delegate(".del_tag","click",function(){
        var tag_name = $(this).prev().text();
        select_tags.remove(tag_name);
        $(this).parent().remove();
    })

    $("#submit").on("click",function(){
        add_article();
    })

    var add_article = function(){
        var article_obj = {};
        article_obj.title = $("input[name='title']").val();
        article_obj.description = $("#description").val();
        article_obj.author = $("input[name='author']").val();
        article_obj.thumbsrc = $("#detail",".thumb_img").attr("src");
        article_obj.is_repost = $("input[name='repost']").prop("checked") ? 1 : 0;
        article_obj.select_tags = select_tags;
        article_obj.content = ue.getContent();
        if(article_obj.title.length < 1){
            show_error("请输入标题!");
            return false;
        }
        if(article_obj.select_tags.length < 1){
            show_error("请选择标签!");
            return false;
        }
        if(article_obj.content.length < 1){
            show_error("请输入内容!");
            return false;
        }
        var add_article = '<?php echo $this->createUrl("index/SaddArticle");?>';
        $.post(add_article,article_obj,function(ret){
            if(ret.status == 1){
                $(".art_error").addClass("hide");
                window.location.href = '<?php echo $this->createUrl("index/Article");?>'
            }else{
                show_error(ret.info);
            }
        },"json")
    }

    var show_error = function(info){
        $("#error_info",".art_error").text(info);
        $(".art_error").removeClass("hide");
    }

    $("body").on("click",function(){
//        if($(".art_error").hasClass("hide")){
//            $(".art_error").addClass("hide");
//        }
    })
</script>