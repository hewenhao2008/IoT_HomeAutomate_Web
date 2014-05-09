<?php

// change the following paths if necessary
$yii='/usr/share/php/yii/framework/yiic.php';
$config=dirname(__FILE__).'/../config/cron.php';

// include Yii bootstrap file
require_once($yii);

// create application instance and run
Yii::createConsoleApplication($config)->run();
