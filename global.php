<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

session_start();
$_SESSION["Error"] = "";

// 判断用户是否登陆
if(!isset($_SESSION["LoginUser"])) {
	$_SESSION["Error"] = "user is not login!";
	header("Location: /dd");
}

// 用户已登录
$RootPath = $_SESSION["RootPath"];
$currentDay = date("Y-m-d", time());

require("$RootPath/Loader.php");
spl_autoload_register("Loader::autoload", true, true);

use doudog\common\dog\User;
$LoginUser = new User();
$LoginUser = unserialize($_SESSION["LoginUser"]);
?>
