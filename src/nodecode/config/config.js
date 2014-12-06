/**
 * Created by Administrator on 2014/11/22.
 */
var dbConfig = require("./db.json");

module.exports = {
    db : 'mongodb://'+dbConfig.host+':'+dbConfig.port+'/'+dbConfig.dbname
};