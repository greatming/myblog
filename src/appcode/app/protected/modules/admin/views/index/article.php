<ul class="nav nav-pills" role="tablist">
    <li role="presentation" class="active"><a href="<?php echo $this->createUrl("index/article");?>">文章管理</a></li>
    <li role="presentation"><a href="<?php echo $this->createUrl("index/addarticle");?>">添加文章</a></li>
</ul>
<div class="hr hr-18 dotted hr-double"></div>
<table id="sample-table-1" class="table table-striped table-bordered table-hover">
<thead>
<tr>
    <th>ID</th>
    <th>标题</th>
    <th>标签</th>

    <th>
        <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
        创建时间
    </th>
    <th>是否转发</th>

    <th></th>
</tr>
</thead>

<tbody>
<?php foreach($list as $article){?>
<tr>
    <td>
        <?php echo  $article->id;?>
    </td>
    <td><?php echo  $article->title;?></td>

    <td>
        <?php $article_tags = json_decode($article->tags,true);?>
        <?php foreach($article_tags as $tags){?>
            <span style="margin-left: 8px;"><?php echo $tags['name'];?></span>
        <?php }?>
    </td>

    <td >
        <?php echo $article->create_time;?>
    </td>
    <td>
        <?php if($article->is_repost == 1){?>
            <i class="ace-icon glyphicon glyphicon-ok"></i>
        <?php }else{?>
            <i class="ace-icon glyphicon glyphicon-remove"></i>
        <?php }?>
    </td>
    <td>
        <div class="hidden-sm hidden-xs btn-group">
            <button class="btn btn-xs btn-info" style="margin-right: 20px;" rel="<?php echo $this->createUrl('index/EditArticle',array('id'=>$article->id));?>" id="edit">
                <i class="ace-icon fa fa-pencil bigger-120"></i>
            </button>
            <button class="btn btn-xs btn-danger" style="margin-right: 20px;" id="del"  rel="<?php echo $article->id;?>">
                <i class="ace-icon fa fa-trash-o bigger-120"></i>
            </button>
            <a target="_blank" href="<?php echo $this->createUrl('/index/detail',array('id'=>$article->id));?>">
            <button class="btn btn-xs btn-success"   rel="<?php echo $article->id;?>">
                <i class="ace-icon fa fa-share bigger-120"></i>
            </button>
            </a>
        </div>

        <div class="hidden-md hidden-lg">
            <div class="inline position-relative">
                <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                    <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                </button>

                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                    <li>
                        <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																			<span class="blue">
																				<i class="ace-icon fa fa-search-plus bigger-120"></i>
																			</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																			<span class="green">
																				<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																			</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																			<span class="red">
																				<i class="ace-icon fa fa-trash-o bigger-120"></i>
																			</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </td>
</tr>
<?php }?>

</tbody>
</table>
<?php $this->widget('CLinkPager', array(
    'pages' => $pages,
    'header'=>"",
    "htmlOptions"=>array(
        "class"=>"pagination"
    )
)) ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/ext/bootstrap/js/bootbox.min.js"></script>
<script>
    $("#edit").on("click",function(){
        var url = $(this).attr("rel");
        window.location.href = url;
    })
    $("#del").on("click",function(){
        bootbox.confirm("Are you sure?", function(result) {
            if(result) {
                //
            }
        });
    })
</script>