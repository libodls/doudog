<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

namespace doudog\common\dog;

class Application {
	public $name;
	public $copyright;

	public function setName($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setCopyright($copyright) {
		$this->copyright = $copyright;
	}

	public function getCopyright() {
		return $this->copyright;
	}
}
?>
