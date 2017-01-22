<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

namespace doudog\common\service;

use doudog\common\dog\User;
use doudog\common\dao\UserDao;

class UserService {

	private $user;
	private $userDao;

	public function __construct() {
		$this->user = new User();
		$this->userDao = new UserDao();
	}

	/**
	 * 登陆入口
	 * 只要通过登陆入口即产生用户信息的SESSION数据，作为正常访问系统的唯一必要条件
	 * 系统内每个页面、模块如果检测不到用户的SESSION信息则直接跳转回登陆界面
	 * 未通过登陆入口，则没有任何用户信息
	 */
	function login() {
		$result = array();
		$cmds = array();
		
		if(isset($_SESSION["Results"])) {
			$results = $_SESSION["Results"];
			echo "5";
		}
		if(isset($_SESSION["Cmds"])) {
			$cmds = $_SESSION["Cmds"];
			echo "6";
		}

		if(isset($_SESSION["tmpUsername"])) {
			$tmpUsername = $_SESSION["tmpUsername"];
			$tmpPassword = $_POST["cmdFormInput"];
			$cmds[] = "";
			$this->user = $this->userDao->getByLoginInf($tmpUsername, $tmpPassword);
		   	if($this->user){
				// 登陆成功，产生用户SESSION
				$_SESSION["LoginUser"] = serialize($this->user);
				$results[] = "Login Success!";
			}
			else {
				// 登陆失败，提示失败
				$results[] = "Sorry, Identification fault!";
			}
			// 清空临时用户数据
			unset($_SESSION["tmpUsername"]);
		}
		else {
			$tmpUsername = $_POST["cmdFormInput"];
			$cmds[] = $tmpUsername;
			if($tmpUsername == null || $tmpUsername == "") {
				$results[] = "Username can not null!";
				unset($_SESSION["tmpUsername"]);
			}
			else {
				$_SESSION["tmpUsername"] = $tmpUsername;
				$results[] = "Password:";
			}
		}
		$_SESSION["Cmds"] = $cmds;
		$_SESSION["Results"] = $results;
	}
}
?>
