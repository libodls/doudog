<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

namespace doudog\tm\service;

use doudog\tm\dao\MatterDao;

class MatterService {
	
	public function getTodoList($user, $day) {
		// 当前页面序号与待办事件真实ID对应
		$no2id = array();
		$matterDao = new MatterDao();
		$matterList = $matterDao->getTodoList($user->getId(), $day);
		for($i = 0; $i < count($matterList); $i ++) {
			$matter = $matterList[$i];
			$color = "#ffffff";
			$finished = "...";
			if($matter->getFinished()) {
				$color = "#008000";
				$finished = "完成";
			}
			elseif(strtotime($matter->getDeadline()) <= strtotime(date("Y-m-d H:i:s"))) {
				$color = "#ff0000";
				$finished = "超期";
			}
			elseif(strtotime($matter->getDeadline()) - strtotime(date("Y-m-d H:i:s")) <= 60*60) {
			$color = "#ffff00";
			$finished = "预警";
			}
			$no2id[$i + 1] = $matter->getId();
			echo "<tr style='color:$color'>";	
			echo "<td class='td-cell'>" . ($i+1) . "</td>";
			echo "<td class='td-cell' style='text-align:left;'>" . $matter->getTitle() . "</td>";
			echo "<td class='td-cell' style='text-align:left;'>" . $matter->getHandle() . "</td>";
			echo "<td class='td-cell'>" . $matter->getDeadline() . "</td>";
			echo "<td class='td-cell'>" . $finished . "</td>";
			echo "</tr>";
		}
		$_SESSION['no2id'] = $no2id;
	}
}
?>
