<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/
namespace doudog\tm\dao;

use doudog\common\dao\Database;
use doudog\tm\dog\Command;
	
class CommandDao {

	private $object;
	private $objectList;
	
	public function __construct() {
		$this->db = new Database();
		$this->objectList = array();
	}

	public function getList($userid, $num) {
		if($num == "") {
			$num = 20;
		}
		$sql = "select * from tm_cmd where uid = $userid order by reqtime desc limit $num";
		$rs = $this->db->query($sql);
		for($i = 1; $row = $this->db->fetch($rs); $i ++) {
			$this->object = new Command();
			$this->object->setId($row["id"]);
			$this->object->setCmd($row["cmd"]);
			$this->object->setReqtime($row["reqtime"]);
			$this->object->setExetime($row["exetime"]);
			$this->object->setResult($row["result"]);
			$this->object->setExecuted($row["executed"]);
			$this->objectList[] = $this->object;
		}
		return $this->objectList;
	}

	public function getOneById($id) {
		if($id == "") {
			echo "Id can not null!";
			return 0;
		}
		$sql = "select * from tm_cmd where id = $id";
		$rs = $this->db->query($sql);
		$row = $this->db->fetch($rs);
		$this->object = new Command();
		$this->object->setId($row["id"]);
		$this->object->setCmd($row["cmd"]);
		$this->object->setReqtime($row["reqtime"]);
		$this->object->setExetime($row["exetime"]);
		$this->object->setResult($row["result"]);
		$this->object->setExecuted($row["executed"]);
		return $this->object;
	}

	/**
	 * 插入一条命令行
	 * 成功返回新增记录ID
	 * 失败返回false
	 */
	public function insert($object) {
		$sql = "insert into tm_cmd(uid, cmd, reqtime, exetime, result, executed) values (" . $object->getUserId() . ", '" . $object->getCmd() . "', '" . $object->getReqtime() . "', '" . $object->getExetime() . "', '" . $object->getResult() . "', " . $object->getExecuted() . ")";
		echo $sql . "<br>";
		echo $object->getExecuted();
		return $this->db->insert($sql);
	}
}
?>
