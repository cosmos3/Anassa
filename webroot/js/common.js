
addEvent(window, 'resize', resizePage);
addEvent(window, 'beforeunload', commonRemove);

function commonRemove() {
	removeEvent(window, 'resize', resizePage);
	removeEvent(window, 'beforeunload', commonRemove);
}

function addEvent(e, type, func) {
	if (navigator.appName != "Microsoft Internet Explorer") {
		e.addEventListener(type, func, false);
		return true;
	} else {
		var r = e.attachEvent("on" + type, func);
		return r;
	}
}

function removeEvent(e, type, func) {
	if (navigator.appName != "Microsoft Internet Explorer") {
		e.removeEventListener(type, func, false);
		return true;
	} else {
		var r = e.detachEvent("on" + type, func);
		return r;
	}
}

function hasFlash() {
	var hasFlash = false;
	try {
		var fo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
		if (fo) {
			hasFlash = true;
		}
	} catch (e) {
		if (navigator.mimeTypes['application/x-shockwave-flash'] != undefined) {
			hasFlash = true;
		}
	}
	alert(hasFlash);
}

function checkFlash() {
	function c(d) {
		d = d.match(/[\d]+/g);
		d.length = 3;
		return d.join(".")
	}
	var a = true;
	var b = "";
	if (navigator.plugins && navigator.plugins.length) {
		var e = navigator.plugins["Shockwave Flash"];
		e && (a = false, e.description && (b = c(e.description)));
		navigator.plugins["Shockwave Flash 2.0"] && (a = false, b = "2.0.0.11")
	} else {
		if (navigator.mimeTypes && navigator.mimeTypes.length) {
			var f = navigator.mimeTypes["application/x-shockwave-flash"];
			a = (f && f.enabledPlugin) && (b = c(f.enabledPlugin.description));
		} else {
			try {
				var g = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
				a = false;
				b = c(g.GetVariable("$version"));
			} catch (h) {
				try {
					g = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");
					a = false;
					b = "6.0.21";
				} catch (i) {
					try {
						g = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
						a = false;
						b = c(g.GetVariable("$version"));
					} catch (j) {
					}
				}
			}
		}
	}
	alert(b);
	var k = b;
	//a ? alert("flash version: " + k) : alert("no flash found");
}

function resizePage() {
	var width = document.getElementsByTagName('body')[0].clientWidth;
	document.getElementById('wrapper').style.width = width + "px";
	width = document.getElementById('header').offsetWidth;
	document.getElementById('menu-top').style.width = (width - 175) + "px";
	var height = document.getElementById('menu-top').offsetHeight;
	document.getElementById('header').style.height = (107 + height) + "px";
	height = document.getElementById('header').offsetHeight;
	if (document.getElementById('header-sub')) {
		document.getElementById('header-sub').style.width = (width - 30) + "px";
		document.getElementById('header-sub').style.marginTop = (height - 10) + "px";
		height = height + document.getElementById('header-sub').offsetHeight;
	}
	document.getElementById('main').style.marginTop = height + "px";
	document.getElementById('main').style.width = (width - 60) + "px";
	document.getElementById('footer').style.width = (width - 30) + "px";
}
