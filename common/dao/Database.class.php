<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

namespace doudog\common\dao;

class Database {

	private $mysqli;
	private $hostname; //服务器地址，含端口号
	private $database; //数据库名
	private $username; //用户名
	private $password; //密码
	private $charset; //数据库编码

	// 连接数据库
	public function __construct() {
		$this->hostname = "127.0.0.1";
		$this->database = "doudog";
		$this->username = "libo";
		$this->password = "334452";
		$this->database = "doudog";
		$this->charset = "utf8";

		$this->mysqli = new \mysqli($this->hostname, $this->username, $this->password, $this->database);
		
		if(mysqli_connect_error()) {
			die("Database Connect Error(" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error);
		}
		if(!$this->mysqli->set_charset($this->charset)) {
			die("Error loading characset set " . $this->charset . " " . $this->mysqli->error);
		}
	}

	// 查询记录
	public function query($sql) {
		$result = $this->mysqli->query($sql);
		if($result) {
			return $result;
		}
		else {
			die("Database Query Error(" . $this->mysqli->errno .") " . $this->mysqli->error);
		}
	}

	// 取结果集中一条记录
	public function fetch($result) {
		return $result->fetch_array(MYSQLI_ASSOC);
	}
	
	// 插入一条记录
	public function insert($sql) {
		if($this->mysqli->query($sql)) {
			return $this->mysqli->insert_id;
		}
		else {
			die("Database Query Error(" . $this->mysqli->errno .") " . $this->mysqli->error);
		}
	}
	
	/**
	 * 修改一条记录
	 */
	public function update($sql) {
		if($this->mysqli->query($sql)) {
			return true;
		}
		else {
			die("Database Query Error(" . $this->mysqli->errno .") " . $this->mysqli->error);
		}
	}
}
?>
