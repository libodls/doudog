<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

namespace doudog\common\dao;

use doudog\common\dao\Database;
use doudog\common\dog\User;

class UserDao{

	private $object;
	private $objectList;
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	/**
	 * 通过用户名和密码查询（登陆）
	 * return user or false
	 */
	public function getByLoginInf($username, $password) {
		$sql = "select * from user where username = '$username' and password = password('$password')";
		echo $sql;
		$rs = $this->db->query($sql);
		if($row = $this->db->fetch($rs)) {
			$this->object = new User();
			$this->object->setId($row["id"]);
			$this->object->setUsername($row["username"]);
			$this->object->setLoginNum($row["login_num"]);
			$this->object->setLastLoginTime($row["last_login_time"]);
			return $this->object;
		}
		else {
			return false;
		}
	}

	/**
	 * 通过ID查询
	 * return matter
	 */
	public function getById($id) {
		$sql = "select * from user where id = $id";
		$rs = $this->db->query($sql);
		$row = $this->db->fetch($rs);
		$this->object = new User();
		$this->object->setId($row["id"]);
		$this->object->setUsername($row["username"]);
		$this->object->setLoginNum($row["login_num"]);
		$this->object->setLastLoginTime($row["last_login_time"]);
		return $this->object;
	}
	
	/**
	 * 插入一条记录
	 */
	public function insert($object) {
		$sql = "insert into user(username, password, last_login_time, login_num) values(" . $object->getUsername() . ", password('" . $object->getPassword() . "'), '" . $object->getLastLoginTime() . "', " . $object->getLoginNum() . ")";
		echo $sql;
		return $this->db->insert($sql);
	}

	/**
	 * 修改一条记录
	 */
	public function changePassword($object) {
		$sql = "update user set password = password('" . $object->getPassword . "') where id = " . $object->getId();
		echo $sql;
		return $this->db->update($sql);
	}
}
?>
