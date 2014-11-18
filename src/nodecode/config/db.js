/**
 * Created by Administrator on 2014/11/13.
 */

var db = {
    user : "",
    pass : "",
    host : "localhost",
    port : "27017",
    dbname : "blog"
};

module.exports = {
    db : 'mongodb://'+db.host+':'+db.port+'/'+db.dbname
}