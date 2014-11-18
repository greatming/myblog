<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'greatming blog',
    'defaultController'=>'index',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.controllers.*',
        'ext.YiiMongoDbSuite.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'hmreal',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('192.168.1.115','::1'),
		),
        'admin'=>array(
            'layout'=>'main',
            'menu'=>require(dirname(__FILE__).'/menu.php')
        ),

	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
            "urlSuffix"=>".html",
            "showScriptName"=>false,
			'rules'=>array(
                'gii'=>'gii',
                'gii/<controller:\w+>'=>'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                'more'=>'index/more',
			),
		),


		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

        'mongodb' => array(
            'class'            => 'EMongoDB', //主文件
            'connectionString' => 'mongodb://127.0.0.1:27017', //服务器地址
            'dbName'           => 'blog',//数据库名称
            'fsyncFlag'        => true, //mongodb的确保所有写入到数据库的安全存储到磁盘
            'safeFlag'         => true, //mongodb的等待检索的所有写操作的状态，并检查
            'useCursor'        => false, //设置为true，将启用游标
        ),

        'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                /*
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                */
				// uncomment the following to show log messages on web pages

//				array(
//					'class'=>'CWebLogRoute',
//                    'categories'=>'system.db.*'
//                ),

			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        'hmDomain' => 'http://hm.greatming.cn'
	),
);
