<link rel="stylesheet" href="/assets/css/detail.css">
<div class="article">
    <h3 class="title"><?php echo $artitle_data->title;?></h3>
    <p class="meta"><span>发布于:<?php echo date("Y-m-d",strtotime($artitle_data->create_time));?></span>
        <span>tags:
            <?php $tags_arr = json_decode($artitle_data->tags,true);?>
            <?php foreach($tags_arr as $tag){?>
                <a href="#"><?php echo $tag['name']?></a>
            <?php }?>
        </span></p>
    <div class="content">
        <?php echo $artitle_data->addi->content;?>
    </div>
</div>