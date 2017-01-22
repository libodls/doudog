/*********************************************************************
 > Author:libo
 > Mail:libodls@139.com
**********************************************************************/

function tmIndexLayout()
{
	var divWidth = WindowWidth - 35;
	var divHeight = WindowHeight - 50;
	var bordercolor = "#2e8b57";
	
	var main = document.getElementById("main");
	var sidebar = document.getElementById("sidebar");

	main.style.width = divWidth * 0.85 + "px";
	main.style.height = divHeight * 0.8 + "px";
	main.style.border = "2px solid " + bordercolor;

	sidebar.style.width = divWidth * 0.15 + "px";
	sidebar.style.height = divHeight * 0.8 + "px";
	sidebar.style.border = "2px solid " + bordercolor;

	cmdHeight = divHeight * 0.2;
	cmdLayout(cmdHeight, bordercolor);
}

