/**
 * Created by Administrator on 2014/11/13.
 */

var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var commentSchema = new Schema({
    user_name : {type : String, trim : true, required: true},
    pid : {type : Number},
    status : {type : Number, default : 0},
    create_time : {type : Date, default : Date.now},
    content : {type : String, required: true}
});

commentSchema.statics = {
    getList : function(cb){
        return this.find({status : 1}).sort({'create_time': 1}).exec(cb);
    }
};

commentSchema.methods = {
    saveComment : function(cb){
        this.pid = 0;
        this.status = 0;
        this.save(cb);
    }
};

module.exports = mongoose.model('comments', commentSchema);








