<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

namespace doudog\common\dog;

class User {
	private $id;
	private $username;
	private $password;
	private $lastLoginTime;
	private $loginNum;


	public function setId($id) {
		$this->id = $id;
	}

	public function getid() {
		return $this->id;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function getUsername() {
		return $this->username;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}

	public function getPassword() {
		return $this->password;
	}
	
	public function setLastLoginTime($lastLoginTime) {
		$this->lastLoginTime = $lastLoginTime;
	}

	public function getLastLoginTime() {
		return $this->lastLoginTime;
	}
	
	public function setLoginNum($loginNum) {
		$this->loginNum = $loginNum;
	}

	public function getLoginNum() {
		return $this->loginNum;
	}
}
?>
