<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

    'connectionString' => 'mysql:host=192.168.1.134;dbname=blog',
    'emulatePrepare' => true,
    'username' => 'hmreal',
    'password' => 'hmreal',
    'charset' => 'utf8',
	
);