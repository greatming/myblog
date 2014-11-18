define(function(require, exports, module) {
    var _ = require('underscore');
    module.exports = {

        init:function(article_list,tags_list){
            load_article(article_list);
            load_tags(tags_list);
        }
    }

    var load_article = function(article_list){
        var html = "";
        var article_template = $("#article-item").text();
        for(var i = 0; i < article_list.length; i++){
            var cur_article = article_list[i];
            cur_article.tags = JSON.parse(cur_article.tags);
            var compiled = _.template(article_template);
            html += compiled(cur_article);
        }
        $("#article-blocks").html(html);
    }

    var load_tags = function(tags_list){
        var html = "";
        for(var i = 0; i < tags_list.length; i++){
            var cur_tag = tags_list[i];
            html += "<a href='/index/search/tag/"+cur_tag.name+"'>"+cur_tag.name+"</a>";
        }
        $("#tag-cloud").html(html);
    }
});