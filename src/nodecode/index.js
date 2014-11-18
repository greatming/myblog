/**
 * Created by Administrator on 2014/11/1.
 */
var express = require('express');
var app = express();
var path = require('path');
var bodyParser = require('body-parser');
var mongoose = require('mongoose');
var config = require("./config/db");

app.set('view engine', 'ejs');
app.locals.baseurl = 'http://blog.greatming.cn/';
app.locals.staprex = '';

app.use(express.static(path.join(__dirname, 'public')));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

//数据库连接
mongoose.connect(config.db);
mongoose.connection.on('error', console.log);

//路由
require("./route")(app);

app.listen(3000);

