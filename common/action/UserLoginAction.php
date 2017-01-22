<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

require("../../Loader.php");
spl_autoload_register("Loader::autoload", true, true);
use doudog\common\dog\User;
use doudog\common\service\UserService;

session_start();

if(isset($_POST["cmdFormInput"])) {
	$cmd = $_POST["cmdFormInput"];
	// 定义不登陆也可使用的命令
	if($cmd == "clear") {
		unset($_SESSION["Cmds"]);
		unset($_SESSION["Results"]);
	}
	else {
		// 如果登陆
		if(isset($_SESSION["LoginUser"])) {
			$results = $_SESSION["Results"];
			$cmds = $_SESSION["Cmds"];
			if(isset($_POST["cmdFormInput"])) {
				$cmd = $_POST["cmdFormInput"];
				if($cmd == "tm") {
					$cmds[] = $cmd;
					$results[] = "SUCCESS!";
					$_SESSION["Cmds"] = $cmds;
					$_SESSION["Results"] = $results;
					header("Location: ../../tm/view/index.php");
					exit();
				}
				elseif($cmd == "") {
					$cmds[] = $cmd;
					$results[] = "";
					$_SESSION["Cmds"] = $cmds;
					$_SESSION["Results"] = $results;
				}
				elseif($cmd == "exit") {
					$cmds[] = $cmd;
					$results[] = "Exit";
					unset($_SESSION["LoginUser"]);
					unset($_SESSION["Cmds"]);
					unset($_SESSION["Results"]);
				}
				else {
					$cmds[] = $cmd;
					$results[] = "doudog: " . $cmd . ": 未找到命令...";
					$_SESSION["Cmds"] = $cmds;
					$_SESSION["Results"] = $results;
				}
			}
		}
		// 如果未登陆
		else {
			$userSer = new UserService();
			$userSer->login();
		}
	}
}

Header("Location: ../../index.php");
exit();
?>
