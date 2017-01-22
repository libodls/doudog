<?php
/*********************************************************************
 * File Name:common/action/Loader.class.php
 * Author:libo
 * Mail:libodls@139.com
 * Created Time:六 12/10 00:10:53 2016
 *********************************************************************/


class Loader {
    public static function autoload($classname) {
		$filename = substr($classname, strpos($classname, "\\"));
        $filename = str_replace("\\", "/", $filename) . ".class.php"; 
		require_once(dirname(__FILE__) . $filename);
    }
}
?>
