<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/
namespace doudog\tm\dao;

use doudog\common\dao\Database;
use doudog\tm\dog\Matter;
	
class MatterDao {

	private $object;
	private $objectList;
	private $db;

	public function __construct() {
		$this->db = new Database();
		$this->objectList = array();
	}

	/**
	 * 以今天为基准，获取所有未完成事务，以及未到达截止日（含今天）的已完成事务
	 */
	public function getTodoList($userid, $deadline) {
		$sql = "select * from tm_todolist where deleted = 0 and uid = $userid and (finished = 0 or (finished = 1 and '$deadline' <= date_format(deadline, '%Y-%m-%d'))) order by finished asc, (unix_timestamp(now()) - unix_timestamp(deadline)) desc";
		$rs = $this->db->query($sql);
		for($i = 1; $row = $this->db->fetch($rs); $i ++) {
			$this->object = new Matter();
			$this->object->setId($row["id"]);
			$this->object->setTitle($row["title"]);
			$this->object->setHandle($row["handle"]);
			$this->object->setDeadline($row["deadline"]);
			$this->object->setPri($row["pri"]);
			$this->object->setFinished($row["finished"]);
			$this->objectList[] = $this->object;
		}
		return $this->objectList;
	}

	/**
	 * 通过ID查询
	 * return matter
	 */
	public function getById($id) {
		$sql = "select * from tm_todolist where id = $id";
		$rs = $this->db->query($sql);
		$row = $this->db->fetch($rs);
		$this->object = new Matter();
		$this->object->setId($row["id"]);
		$this->object->setTitle($row["title"]);
		$this->object->setHandle($row["handle"]);
		$this->object->setDeadline($row["deadline"]);
		$this->object->setPri($row["pri"]);
		$this->object->setFinished($row["finished"]);
		return $this->object;
	}
	
	/**
	 * 插入一条记录
	 */
	public function insert($object) {
		$currentTime = date("Y-m-d H:i:s");
		$sql = "insert into tm_todolist(uid, title, handle, deadline, pri, addtime) values(" . $object->getUserId() . ", '" . $object->getTitle() . "', '" . $object->getHandle() . "', '" . $object->getDeadline() . "', " . $object->getPri() . ", '$currentTime')";
		echo $sql;
		return $this->db->insert($sql);
	}

	/**
	 * 修改一条记录
	 */
	public function update($object) {
		$sql = "update tm_todolist set title = '" . $object->getTitle() . "', handle = '" . $object->getHandle() . "', deadline = '" . $object->getDeadline() . "', pri = " . $object->getPri() . ", finished = " . $object->getFinished() . " where id = " . $object->getId();
		echo $sql;
		return $this->db->update($sql);
	}
	
	/*
	 * 删除一条记录
	 */
	public function delete($id) {
		$sql = "update tm_todolist set deleted = 1 where id = $id";
		echo $sql;
		return $this->db->query($sql);
	}
	
	/*
	 * 完成一条记录
	 */
	public function finished($id) {
		$sql = "update tm_todolist set finished = 1 where id = $id";
		echo $sql;
		return $this->db->query($sql);
	}
}
?>
