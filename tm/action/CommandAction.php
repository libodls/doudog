<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/

require_once("../global.php");

use doudog\tm\service\CommandService;

$cmd = trim($_POST["cmdFormInput"]);
//调用类方法处理请求
$cmdSer = new CommandService();
$cmdSer->add($LoginUser, $cmd);
header("Location: ../view/index.php");
?>
