/*********************************************************************
 > Author:libo
 > Mail:libodls@139.com
**********************************************************************/

// 定义全局变量
var WindowWidth, WindowHeight;
var ISIE;

// 赋值全局变量
ISIE = isIE();
WindowWidth = getWindowWidth();
WindowHeight = getWindowHeight();


//alert(WindowWidth + "-" + WindowHeight + "-" + ISIE);

// 判度是否是IE浏览器
function isIE() {
	if(!!window.ActiveXObject || "ActiveXObject" in window) {
		return true;
	}
	else {
		return false;
	}
}


function test() {
	return "abc";
}

// 获取页面宽度
function getWindowWidth() {
	if(ISIE) {
	    if(document.compatMode == "CSS1Compat") {
		    return document.documentElement.clientWidth;
		}
		else {
		    return document.body.clientWidth;
		}
	}
	else {
		return window.innerWidth;
	}
}

// 获取页面高度
function getWindowHeight() {
	if(ISIE) {
	    if(document.compatMode == "CSS1Compat") {
		    return document.documentElement.clientHeight;
		}
		else {
		    return document.body.clientHeight;
		}
	}
	else {
		return window.innerHeight;
	}
}



function showTime(id)
{
	document.getElementById(id).innerHTML = new Date();
	setTimeout("clock();", 1000);
}

