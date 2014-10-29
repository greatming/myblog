<link rel="stylesheet" href="/assets/css/detail.css">
<div id="tag-cloud">
    <?php foreach($tags_list as $tag){?>
        <a href="#"><?php echo $tag['name']?></a>
    <?php } ?>
</div>