<?php
/*********************************************************************
 * Author:libo
 * Mail:libodls@139.com
 *********************************************************************/
session_start();

require("Loader.php");
spl_autoload_register("Loader::autoload", true, true);
use doudog\common\dog\User;

// 系统初始化
$RootPath = dirname(__FILE__);
$Project = "DouDog";

// 初始化结果写入SESSION
$_SESSION["RootPath"] = $RootPath;
$_SESSION["Project"] = $Project;
?>

<!DOCTYPE HTML>

<html>

<head>

	<meta charset="utf-8">
	<title><?php echo $Project; ?></title>
	<script type="text/javascript" src="common/view/js/base.js"></script>
	<script type="text/javascript" src="common/view/js/cmd.js"></script>
	<link rel="stylesheet" href="common/view/css/base.css" type="text/css" />
	<link rel="stylesheet" href="common/view/css/cmd.css" type="text/css" />
</head>

<body>

<div id="cmd">
	<div>
		<div class='cmdlog'>李博的个人主页 苏ICP备16068440号-1<div>
		<div class='cmdlog'>Welcome to DouDog!</div>
		<div class='cmdlog'>I'm libo, a government staff who understand the programmer.</div>
		<div class='cmdlog'>This is a small program imitating Linux bash.</div>
		<div class='cmdlog'>Now, the program is in the process of building, You can login by guest, the password is null, just null! You can try to enter command clear tm and exit.</div>
		<?php
		$prompt = "";
		if(!isset($_SESSION["LoginUser"])) {
			$prompt = "[~@DouDog] ";
			echo "<div class='cmdlog'>Please login.</div>";
		}
		else {
			$user = new User();
			$user = unserialize($_SESSION["LoginUser"]);
			$prompt = "[" . $user->getUsername() . "@" . $Project . " ~]$ ";
		}
		if(isset($_SESSION["Cmds"])) {
			$cmds = $_SESSION["Cmds"];
			$results = $_SESSION["Results"];
			for($i = 0; $i < count($cmds) - 1; $i ++) {
				if($i == 0 || ($i > 0 && $results[$i - 1] != "Password:")) {
					echo "<div class='cmdlog'>" . $prompt . " " . $cmds[$i] . "</div>";
				}
				if($results[$i] != "") {
					echo "<div class='cmdlog'>" . $results[$i] . "</div>";
				}
			}
			if($i == 0 || ($i > 0 && $results[$i - 1] != "Password:")) {
				echo "<div class='cmdlog'>" . $prompt . " " . $cmds[$i] . "</div>";
			}
			if(end($results) == "Password:") {
				$prompt = "Password:";
			}
			elseif(end($results) != "") {
				echo "<div class='cmdlog'>" . end($results) . "</div>";
			}
		}
		?>
	</div>

	<div class="cmdlog">
	<form action="common/action/UserLoginAction.php" method="post" style="text-align:left;">
		<?php echo $prompt; ?>
		<input 
			type="text" id="cmdFormInput" name="cmdFormInput" class="cmdinput" value="" autocomplete="off" 
			<?php
			if($prompt == "Password:") {
				echo "onfocus=\"this.type='password'\"";
			}	
			?> 
		/>
	</form>
	</div>
</div>

<script>
cmdLayout("", "");
</script>
</body>

</html>
