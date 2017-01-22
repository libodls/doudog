<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

namespace doudog\tm\dog;

class Matter {
	
	private $id;
	private $userId;
	private $title;
	private $handle;
	private $deadline;
	private $pri;
	private $finished;
	private $addtime;
	private $updatetime;
	private $finishtime;
	private $isdeleted;
	
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

	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getTitle() {
		return $this->title;
	}

	public function setHandle($handle) {
		$this->handle = $handle;
	}
	
	public function getHandle() {
		return $this->handle;
	}

	public function setDeadline($deadline) {
		$this->deadline = $deadline;
	}
	
	public function getDeadline() {
		return $this->deadline;
	}

	public function setPri($pri) {
		$this->pri = $pri;
	}
	
	public function getPri() {
		return $this->pri;
	}

	public function setFinished($finished) {
		$this->finished = $finished;
	}
	
	public function getFinished() {
		return $this->finished;
	}

	public function setAddtime($addtime) {
		$this->addtime = $addtime;
	}
	
	public function getAddtime() {
		return $this->addtime;
	}

	public function setUpdatetime($updatetime) {
		$this->updatetime = $updatetime;
	}
	
	public function getUpdatetime() {
		return $this->updatetime;
	}

	public function setFinishtime($finishtime) {
		$this->finishtime = $fihishtime;
	}
	
	public function getFinishtime() {
		return $this->finishtime;
	}

	public function setDeleted($deleted) {
		$this->deleted = $deleted;
	}
	
	public function getDeleted() {
		return $this->deleted;
	}
}
?>
