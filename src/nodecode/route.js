/**
 * Created by Administrator on 2014/11/14.
 */
var path = require('path');
var controller = require(path.join(__dirname, 'controller/comment'));
module.exports = function(app){

    app.use(function(req, res, next){
        next();
    });

    app.get('/comment', controller.index);
    app.post('/comment/add', controller.add);
    app.post('/comment/getCommentList', controller.getList);
}
