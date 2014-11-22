define(function(require, exports, module) {
    var moment = require("moment");
    require("Jplugin/popup/prompt");
    module.exports = {
        init:function(){
            getCommentList();
            $("#submit").on("click",function(){
                var post_obj = {
                    user_name : $("input[name='user_name']").val(),
                    content : $("#content").val()
                };
                if(check_comment_submit(post_obj)){
                    $.post("/comment/add",post_obj,function(ret){
                        if(ret.status == 1){
                            $.prompt("评论成功，内容审核中...", {
                                submit: function(e,v,m,f){
                                    window.location.reload(true);
                                }
                            });
                        }else{
                            $.prompt("评论失败！");
                        }
                    },"json")
                }
            });
        }
    };

    var getCommentList = function(){
        $.post("/comment/getCommentList",{},function(ret){
            if(ret.status == 1){
                showComments(ret.data);
            }
        },"json");
    };

    var showComments = function(comments){
        html = '';
        for(var i = 0; i < comments.length; i++){
            var comment = comments[i];
            html += '<li><div class="head"><img src="image/commonhead.jpg"></div>';
            html += '<div class="detail"><p class="top"><span>'+comment.user_name+'</span>'+moment(comment.create_time).format("YYYY-MM-DD HH:mm")+'</p>';
            html += '<div class="content">'+comment.content+'</div></div></li>';
        }
        $(".comment").html(html);
    };


    var check_comment_submit = function(obj){
        if(!obj.user_name){
            errorTip($("#user_name"));
            return false;
        }
        if(!obj.content){
            errorTip($("#content"));
            return false;
        }
        return true;
    };

    var errorTip = function(dom){
        $(dom).css('borderColor' , "red");
    };
});