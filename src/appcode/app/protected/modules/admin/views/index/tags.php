<style type="text/css">
    .mright{
        margin-right: 15px;
    }
</style>
<div class="row">
    <div class="col-md-10" id="tag_list">
        <?php foreach($tags_list as $tag){?>
            <span><span class="label label-xlg label-primary arrowed arrowed-right"><?php echo $tag->name;?></span><span rel="<?php echo $tag->id;?>" class="glyphicon glyphicon-remove mright del_tag"></span></span>
        <?php }?>
    </div>
</div>
<div class="hr hr-18 dotted hr-double"></div>
<div class="row">
    <div class="col-md-5">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">添加标签</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <form>
                        <!-- <legend>Form</legend> -->
                        <fieldset>
                            <label>标签</label>

                            <input type="text" name="tag_name" placeholder="input tag" />
                            <span class="help-block">please input tags text in here.</span>
                        </fieldset>
                        <div role="alert" class="alert alert-danger hidden errror_info">
                            <strong>
                                <i class="ace-icon fa fa-times"></i>
                                Error
                            </strong>
                            <span class="info">Change a few things up and try submitting again.</span>
                        </div>

                        <div class="form-actions center">
                            <button type="button" class="btn btn-sm btn-success">
                                Submit
                                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap//js/bootbox.min.js"></script>
<script type="text/javascript">
    $(function(){
        var add_tag_url = "<?php echo $this->createUrl("index/SaddTag");?>";
        var del_tag_url = "<?php echo $this->createUrl("index/SdelTag");?>";
        $(".btn-success").on("click",function(){
            $name = $("input[name='tag_name']").val();
            if(!$name){
                $(".info",".errror_info").text("请输入正确的标签!");
                $(".errror_info").removeClass("hidden");
                return false;
            }

            $.post(add_tag_url,{name:$name},function(ret){
                if(ret.status == 1){
                    var ret_data = JSON.parse(ret.data);
                    $("input[name='tag_name']").val("");
                    var html = '<span><span class="label label-xlg label-primary arrowed arrowed-right">'+$name+'</span><span rel="'+ret_data.id+'" class="glyphicon glyphicon-remove mright del_tag"></span></span>';
                    $("#tag_list").append(html);
                }else{
                    $(".info",".errror_info").text(ret.info);
                    $(".errror_info").removeClass("hidden");
                    return false;
                }
            },"json")
        })
        $("#tag_list").delegate(".del_tag","click",function(){
            var that = this;
            bootbox.confirm("Are you sure?", function(result) {
                if(result) {
                    var $id = $(that).attr("rel");
                    $.post(del_tag_url,{id:$id},function(ret){
                        if(ret.status == 1){
                            $(that).parent().remove();
                        }else{
                            alert("error");
                        }
                    },"json")
                }
            });

        })

        $("input[name='tag_name']").on("click",function(){
            $(".errror_info").addClass("hidden");
        })
    })
</script>
