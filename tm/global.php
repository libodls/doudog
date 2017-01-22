<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

$APP_PATH = dirname(__FILE__);
include("$APP_PATH/../global.php");
use doudog\common\dog\Application;
/*
 * Initialize the project
 */
$app = new Application;
$app->setName("Time Manage");
$app->setCopyright("Copyright &copy; 2016 LIBO All Rights Reserved");
?>
