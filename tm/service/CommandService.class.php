<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/
namespace doudog\tm\service;

use doudog\tm\dog\Matter;
use doudog\tm\dao\MatterDao;
use doudog\tm\dog\Command;
use doudog\tm\dao\CommandDao;

class CommandService {
	private $cmd;
	private $cmdList;
	private $matter;
	private $cmdDao;
	private $matterDao;


	public function __construct() {
		$this->cmdDao = new CommandDao();
	}
	/**
	 * 获取命令行日志
	 */
	public function getCmdLogs($user, $logNum) {
		$cmdList = $this->cmdDao->getList($user->getId(), $logNum);
		for($i = count($cmdList) - 1; $i >= 0; $i --) {
			$cmd = $cmdList[$i];
			echo "<div class='cmdlog'>[" . $user->getUsername() . "@DouDog tm]$ " . $cmd->getCmd() . "</div>";
			if($cmd->getResult() != 1) {
				echo "<div class='cmdlog'>" . $cmd->getResult() . "</div>";
			}
		}
	}

	public function add($user, $cmd) {
		// 从页面表单获取命令行数据
		$userId = $user->getId();
		$reqTime = date("Y-m-d H:i:s");
		
		// 执行命令行并获得执行结果
		$result = $this->execute($user, $cmd);
		$exetime = date("Y-m-d H:i:s");
		
		// 封装命令行对象并写入数据库
		$this->cmd = new Command();
		$this->cmd->setUserId($userId);
		$this->cmd->setCmd($cmd);
		$this->cmd->setReqtime($reqTime);
		$this->cmd->setExetime($exetime);
		$this->cmd->setResult($result);
		$this->cmd->setExecuted($result == 1?1:0);
		$cmdDao = new CommandDao();
		
		return $cmdDao->insert($this->cmd);
	}

	// 执行命令行函数
	private function execute($user, $cmd) {
		//echo "$cmd<br>";
		if(preg_match("/(^\w*)/", $cmd, $m_cmdname)) {
			$cmdname = trim($m_cmdname[1]);
			//echo "Command:$cmdname<br>";
			// 处理new命令
			if($cmdname == "new") {
				// 解析new命令关键参数-t
				$title = $this->analytic_t($cmd);
				if($title) {
				   	// 获取参数
				   	$userId = $user->getId();
					$handle = $this->analytic_h($cmd);
					$deadline = $this->analytic_d($cmd);
					$pri = $this->analytic_p($cmd);
					// 修正参数值
					if(!$deadline) {
					    $deadline = strtotime(date("Y-m-d H:i:s")) < strtotime(date("Y-m-d") . " 17:00:00")?date("Y-m-d") . " 18:00:00" : date("Y-m-d", strtotime("+1 day")) . " 18:00:00";
					}
					$pri = $pri?$pri:3;
			    	// 封装Matter对象，并写入数据库
					$this->matter = new Matter();
					$this->matter->setUserId($userId);
					$this->matter->setTitle($title);
					$this->matter->setHandle($handle);
					$this->matter->setDeadline($deadline);
					$this->matter->setPri($pri);
					$matterDao = new MatterDao();
					$matterId = $matterDao->insert($this->matter);
				}
				else {
					return "$cmdname: 缺少关键参数 -t";
				}
			}
			elseif($cmdname == "mod") {
				// 解析mod命令关键参数 -i（即需要修改的事件序号）
				if($no = $this->analytic_i($cmd)) {
					// 序号不能为空
					if($no == "") {
						return "$cmdname: -i 值不能为空";
					}
					// 序号不能超出页面显示的序号范围
					$no2id = $_SESSION['no2id'];
					if($no == 0 or $no > count($no2id)) {
						return "$cmdname: -i 参数值必须在页面显示序号范围内";
					}
					// 获取要修改的事件ID和事件
					$matterId = $no2id[$no];
					$matterDao = new MatterDao();
					$this->matter = $matterDao->getById($matterId);
					$title = $this->analytic_t($cmd);
					$handle = $this->analytic_h($cmd);
					$deadline = $this->analytic_d($cmd);
					$pri = $this->analytic_p($cmd);
					$finished = $this->analytic_f($cmd);

					if(!$title && !$handle && !$deadline && !$pri && !$finished) {
						return "$cmdname: 什么都没有做";
					}
					// 更新需要修改的数据
					if($title) {
						$this->matter->setTitle($title);
					}
					if($handle) {
						$this->matter->setHandle($handle);
					}
					if($deadline) {
						$this->matter->setDeadline($deadline);
					}
					if($pri) {
						$this->matter->setPri($pri);
					}
					if($finished) {
					    	$this->matter->setFinished($finished);
					}
					$matterDao->update($this->matter);
				}
				else {
					return "$cmdname: 缺少关键参数 -i";
				}

			}
			elseif($cmdname == "del") {
				$no = $this->analytic_single($cmd);
				if($no) {
					// 序号不能为空
					if($no == "") {
						return "$cmdname: 参数不能为空";
					}
					// 序号不能超出页面显示的序号范围
					$no2id = $_SESSION['no2id'];
					if($no == 0 or $no > count($no2id)) {
						return "$cmdname: 参数值必须在页面显示序号范围内";
					}
					// 获取要修改的事件ID和事件
					$matterId = $no2id[$no];
					$matterDao = new MatterDao();
					$matterDao->delete($matterId);
				}
				else {
					return "$cmdname: 缺少关键参数";
				}
			}
			elseif($cmdname == "fin") {
				$no = $this->analytic_single($cmd);
				if($no) {
					// 序号不能为空
					if($no == "") {
						return "$cmdname: 参数不能为空";
					}
					// 序号不能超出页面显示的序号范围
					$no2id = $_SESSION['no2id'];
					if($no == 0 or $no > count($no2id)) {
						return "$cmdname: 参数值必须在页面显示序号范围内";
					}
					// 获取要修改的事件ID和事件
					$matterId = $no2id[$no];
					$matterDao = new MatterDao();
					$matterDao->finished($matterId);
				}
				else {
					return "$cmdname: 缺少关键参数";
				}
			}
			elseif($cmdname == "exit") {
				Header("Location: /dd");
				exit();
			}
			else {
				return "$cmdname: 没有这个命令";
			}
		}
		else {
			return "$cmdname: 缺少参数";
		}
		return true;
	}

	/**
	 * 解析参数 -t
	 * 解析成功返回matter
	 * 解析失败返回false
	 * new和mod命令的参数
	 */
	private function analytic_t($cmd) {
		if(preg_match("/(\s\-t\s)(.*?)((\s\-\w\s)|$|\-\w$)/", $cmd, $m_matter)) {
			//参数的值是第二个子匹配（第二个小括号）
			return trim($m_matter[2]);
		} else {
			return false;
		}
	}

	/**
	 *  解析参数 -h
	 *  解析成功返回handle
	 *  解析失败返回false
	 *  new和mod命令的参数
	 */
	private function analytic_h($cmd) {
		if(preg_match("/(\s\-h\s)(.*?)((\s\-\w\s)|$|\-\w$)/", $cmd, $m_handle)) {
			return trim($m_handle[2]);
		} else {
			return  false;
		}
	}

	/**
	 *  解析参数 -d
	 *  解析成功返回deadline
	 *  解析失败返回false
	 *  new和mod命令的参数
	 */
	private function analytic_d($cmd) {
		if(preg_match("/(\s\-d\s)(.*?)((\s\-\w\s)|$|\-\w$)/", $cmd, $m_deadline)) {
			return trim($m_deadline[2]);
		} else {
			return  false; 
		}
	}

	/**
	 *  解析参数 -p
	 *  解析成功返回pri
	 *  解析失败返回false
	 *  new和mod命令的参数
	 */
	private function analytic_p($cmd) {
		if(preg_match("/(\s\-p\s)([1-5]{1,1})((\s\-\w\s)|$|\-\w$)/", $cmd, $m_pri)) {
			return trim($m_pri[2]);
		} else {
			return false;
		}
	}

	/**
	 *  解析参数 -i
	 *  解析成功返回序号
	 *  解析失败返回false
	 *  mod命令的关键参数
	 */
	private function analytic_i($cmd) {
		if(preg_match("/(\s\-i\s)([0-9]{1,2})((\s\-\w\s)|$|\-\w$)/", $cmd, $m_no)) {
			return trim($m_no[2]);
		} else {
			return false;
		}
	}

	/**
	 * 解析参数 -f
	 * 解析成功返回1
	 * 解析失败返回false
	 * mod修改命令的参数，不需要参数值
	 */
	private function analytic_f($cmd) {
		if(preg_match("/(\s\-f)((\s)|$)/", $cmd, $m_finished)) {
			return 1;
		}
		else {
			return false;
		}
	}

	/**
	 * 解析无标记参数，值为整数，如del 1
	 * 解析成功返回参数值
	 * 解析失败返回false
	 * del、fnsh命令的参数
	 */
	private function analytic_single($cmd) {
		if(preg_match("/^[a-zA-Z]{3,4}\s*(\d*)$/", $cmd, $m)) {
			return $m[1];
		}
		else {
			return false;
		}
	}
}
?>
