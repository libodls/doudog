/*********************************************************************
 > Author:libo
 > Mail:libodls@139.com
**********************************************************************/

// 命令行（包含已执行命令和命令输入行）布局
function cmdLayout(height, bordercolor) {
	var divWidth = WindowWidth - 35;
	// DIV
	var cmd = document.getElementById("cmd");
	if(height != "") {
		cmd.style.height = height + "px";
		cmd.scrollTop = cmd.scrollHeight;
	}
	if(bordercolor != "") {
		cmd.style.border = "2px solid " +bordercolor;
	}

	//FORM
	var cmdFormInput = document.getElementById("cmdFormInput");
	cmdFormInput.style.width = WindowWidth - 200 + "px";
	cmdFormInput.focus();
}


// 选中文本框，并将光标移到文字最后
function focusInput(inputId) {
	inputObj = document.getElementById(inputId);
	if(ISIE) {
		inputObj.focus();
		var sel = document.selection.createRange();
		sel.moveStart('character', -inputObj.value.length);
		currentPostion = sel.text.length;
		var range = inputObj.createTextRange();
		range.moveStart('character', currentPostion);
		range.collapse();
		range.select();
	}
	else{
		inputObj.focus();
	}
}

document.onclick = function focusCmd() {
	focusInput("cmdFormInput");
}
