<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

require_once("../global.php");
require_once("$APP_PATH/view/header.php");

use doudog\tm\service\MatterService;
use doudog\tm\service\CommandService;
?>

<div id="main" style="float:left; overflow:auto;">
<table width="100%" cellspacing="0">
<tr>
	<td class="td-title" style="width:50px;">序号</td>
	<td class="td-title" style="width:300px;">待办事务</td>
	<td class="td-title" style="width:300px;">处理情况</td>
	<td class="td-title" style="width:100px;">完成时限</td>
	<td class="td-title" style="width:100px;">结果</td>
</tr>
<?php
$matterService = new MatterService();
$matterService->getTodoList($LoginUser, $currentDay);
?>
</table>
</div>
<div id="sidebar" style="float:right;">
	<div style="padding:5px 0px; text-align:center; font-size:16px;" id="clock"></div>
	<div style="text-align:left; padding:5px; line-height:20px;">
		<div>new 新增命令</div>
		<div style="padding:0px 0px 0px 10px;">
			-t 标题<br>
			-h 处理情况<br>
			-d 完成时限<br>
			-p 优先级 1-5
		</div>
		<div>mod 修改命令</div>
		<div style="padding:0px 0px 0px 10px;">
			-i 序号<br>
			-t 标题<br>
			-h 处理情况<br>
			-d 完成时限<br>
			-p 优先级 1-5<br>
			-f 完成
		</div>
		<div>fin 完成命令</div>
		<div style="padding:0px 0px 0px 10px;">
			fin 序号
		</div>
		<div>del 删除命令</div>
		<div style="padding:0px 0px 0px 10px;">
			del 序号
		</div>
		<div>exit 退出命令</div>
	</div>
</div>
<div style="clear:both;"></div>

<div id = "cmd" style="margin:10px 0px 0px 0px; padding:2px; overflow:auto;">
	<div>
		<?php
		$cmdSer = new CommandService();
		$cmdSer->getCmdLogs($LoginUser, 20);
		?>
	</div>

	<div class="cmdlog">
	<form action="<?php echo "../action/CommandAction.php"; ?>" method="post" style="text-align:left;">
	[<?php echo $LoginUser->getUsername(); ?>@DouDog tm]$ 
		<input type="text" id="cmdFormInput" name="cmdFormInput" class="cmdinput" value="" autocomplete="off" />
	</form>
	</div>
</div>



<script language="javascript">
	tmIndexLayout();
	showTime("clock");
</script>
