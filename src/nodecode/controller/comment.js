/**
 * 留言首页
 * @param req
 * @param res
 */
var mongoose = require('mongoose');

var Comment = require('../model/comment');
var index = function(req,res){
    res.render("comment");
};

var add = function(req,res){
    var commentModel = new Comment(req.body);
    commentModel.saveComment(function(err,comments){
        if(err) res.json({ status: 0 });
        res.json({ status: 1 });
    });
};

var getList = function(req,res){
    Comment.getList(function(err,comments){
        if(err) res.json({ status: 0 });
        res.json({ status: 1 ,data : comments });
    });
}
module.exports = {
    index: index,
    add: add,
    getList: getList
}