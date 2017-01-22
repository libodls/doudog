<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

namespace doudog\tm\dog;

class Command {
	
	private $id;
	private $userId;
	private $cmd;
	private $reqtime;
	private $exetime;
	private $result;
	private $executed;
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getId() {
		return $this->id;
	}

	public function setUserId($userId) {
		$this->userId = $userId;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setCmd($cmd) {
		$this->cmd = $cmd;
	}
	
	public function getCmd() {
		return $this->cmd;
	}

	public function setReqtime($reqtime) {
		$this->reqtime = $reqtime;
	}
	
	public function getReqtime() {
		return $this->reqtime;
	}

	public function setExetime($exetime) {
		$this->exetime = $exetime;
	}
	
	public function getExetime() {
		return $this->exetime;
	}

	public function setResult($result) {
		$this->result = $result;
	}
	
	public function getResult() {
		return $this->result;
	}

	public function setExecuted($executed) {
		$this->executed = $executed;
	}
	
	public function getExecuted() {
		return $this->executed;
	}
}
?>
