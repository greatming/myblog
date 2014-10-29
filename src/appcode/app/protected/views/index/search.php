<link rel="stylesheet" href="/assets/css/index.css">
<div class="article-list">
    <div id="article-blocks">
        <?php foreach($article_list as $article){?>
            <div class="art-block">
                <p class="title"><a href="/index/detail/<?php echo $article->id;?>"><?php echo $article->title;?></a></p>
                <div class="des">
                    <span class="abs">&lt;摘要&gt;:</span><?php echo $article->description;?>
                </div>
                <div class="meta">
                    <span>发布于:<?php echo $article->create_time;?></span>|<span>TAGS:
                        <?php $tags_arr = json_decode($article->tags,true);?>
                        <?php foreach($tags_arr as $tag){?>
                            <a href="/index/search/tag/<?php echo $tag['name']?>"><?php echo $tag['name']?></a>
                        <?php }?>
                    </span>
                </div>
            </div>
        <?php }?>

    </div>

</div>
<?php $this->widget('application.views.widget.CLinkPager', array(
    'pages' => $page,
    'header'=>"",
    'firstPageLabel' => '',
    'lastPageLabel' => '',
    'prevPageLabel' => '上一页',
    'nextPageLabel' => '下一页',
    "htmlOptions"=>array(
        "class"=>"pagination",

    )
)) ?>