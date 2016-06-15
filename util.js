/**
 * Make rel="external" links open in a new window/tab
 */ 
function externalLinks()
{
	if (!document.getElementsByTagName) return;
	
	var anchors = document.getElementsByTagName("a");
	for (var i = 0; i < anchors.length; i++)
	{
		var anchor = anchors[i];
		if (anchor.getAttribute("rel") == "external")
			anchor.target = "_blank";
	}
}
window.onload = function() { externalLinks(); }