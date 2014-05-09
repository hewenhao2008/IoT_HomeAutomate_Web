<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Cron Application',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.library.*',
	),

	// application components
	'components'=>array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=IoT_Challenge',
			'emulatePrepare' => true,
			'username' => 'iot_admin',
			'password' => 'IoT_Challenge',
			'charset' => 'utf8',
		),
	),
);
