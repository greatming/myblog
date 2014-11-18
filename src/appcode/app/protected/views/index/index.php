<link rel="stylesheet" href="/assets/css/index.css">
<div class="container">
    <div id="article-blocks">

    </div>
    <div class="more"><a href="/more">more >></a></div>
</div>
<div class="right">
    <h3 class="r-title">TAGS</h3>
    <div id="tag-cloud">
    </div>
</div>
<script type="text/template" id="article-item">
    <div class="art-block">
        <p class="title"><a href="/index/detail/<%= id %>"><%= title %></a></p>
        <div class="des">
            <span class="abs">&lt;摘要&gt;:</span><%= description %>
        </div>
        <div class="meta">
            <span>发布于:<%= create_time %></span>|<span>TAGS:
                <% for(var n = 0; n < tags.length; n++){%>
                    <a href="/index/search/tag/<%= tags[n].name %>"><%= tags[n].name %></a>
                <% } %>
            </span>
        </div>
    </div>
</script>
<script src="/assets/js/sea/sea.js"></script>
<script src="/assets/js/hm.js"></script>
<script>
    seajs.use('sea-modules/article/index', function(index){
        var article_list = <?php echo $article_list;?>;
        var tags_list = <?php echo $tags_list;?>;
        index.init(article_list,tags_list);
    });
</script>

