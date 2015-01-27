
addEvent(window, "resize", resizePage);
addEvent(window, "beforeunload", commonRemove);

function commonRemove() {
	removeEvent(window, "resize", resizePage);
	removeEvent(window, "beforeunload", commonRemove);
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

function resizePage() {
	var width = document.getElementsByTagName("body")[0].clientWidth;
	document.getElementById("wrapper").style.width = width + "px";
	width = document.getElementById("header").offsetWidth;
	document.getElementById("menu-top").style.width = (width - 160) + "px";
	var height = document.getElementById("menu-top").offsetHeight;
	document.getElementById("header").style.height = (80 + height) + "px";
	height = document.getElementById("header").offsetHeight;
	if (document.getElementById("header-sub")) {
		document.getElementById("header-sub").style.width = (width - 10) + "px";
		document.getElementById("header-sub").style.marginTop = (height - 10) + "px";
		height = height + document.getElementById("header-sub").offsetHeight;
	}
	document.getElementById("main").style.marginTop = height + "px";
	document.getElementById("main").style.width = (width - 20) + "px";
	document.getElementById("footer").style.width = width + "px";
}

function setFocus(id) {
	document.getElementById(id).focus();
}

function divShow(id) {
	document.getElementById(id).style.display = "block";
}

function divHide(id) {
	document.getElementById(id).style.display = "none";
}

function cmbAddOptionFromOption(cmbId_1, cmbId_2) {
	var cmb_2 = document.getElementById(cmbId_2);
	var value = cmb_2.options[cmb_2.selectedIndex].value;
	var text = cmb_2.options[cmb_2.selectedIndex].text;
	if (text != "") {
		var cmb_1 = document.getElementById(cmbId_1);
		var opt_1 = document.createElement("option");
		opt_1.value = value;
		opt_1.text = text;
		cmb_1.appendChild(opt_1);
		//cmb_1.value = cmb_1.options[cmb_1.options.length - 1].value;
		cmb_1.selectedIndex = cmb_1.options.length - 1;
	}
}
function cmbAddOptionFromText(cmbId, txtId, value) {
	var txt = document.getElementById(txtId);
	var text = txt.value;
	if (text != "") {
		var cmb = document.getElementById(cmbId);
		var opt = document.createElement("option");
		opt.value = value;
		opt.text = text;
		cmb.appendChild(opt);
		//cmb.value = cmb.options[cmb.options.length - 1].value;
		cmb.selectedIndex = cmb.options.length - 1;
		txt.value = "";
	}
}
function cmbRemoveOption(cmbId) {
	var cmb = document.getElementById(cmbId);
	var ix = cmb.options[cmb.selectedIndex];
	cmb.removeChild(ix);
}
function cmbSelectChk(cmbId, chkId, all, char) {
	var cmb = document.getElementById(cmbId);
	var arr = all.split(char);
	for (i = 0; i < arr.length; i++) {
		var id = chkId + arr[i];
		var chk = document.getElementById(id);
		chk.checked = false;
	}
	arr = cmb.options[cmb.selectedIndex].value.split(char);
	for (i = 0; i < arr.length; i++) {
		var id = chkId + arr[i];
		var chk = document.getElementById(id);
		chk.checked = true;
	}
}
function cmbSelectRb(cmbId, rbId) {
	var cmb = document.getElementById(cmbId);
	var ix = cmb.options[cmb.selectedIndex];
	rbId = rbId + ix.value;
	var rb = document.getElementById(rbId);
	rb.checked = true;
}
function chkChangeCmb(cmbId, chkId, value, char) {
	var cmb = document.getElementById(cmbId);
	var chk = document.getElementById(chkId);
	var ix = cmb.options[cmb.selectedIndex];
	if (chk.checked == true) {
		if (ix.value != "") {
			ix.value += char;
		}
		ix.value += value;
	} else {
		ix.value = ix.value.replace(value, "");
		ix.value = ix.value.replace(char + char, char);
	}

	if (ix.value.length > 0) {
		if (ix.value[0] == char) {
			ix.value = ix.value.substr(1, ix.value.length - 1);
		}
	}
	if (ix.value.length > 1) {
		if (ix.value[ix.value.length - 1] == char) {
			ix.value = ix.value.substr(0, ix.value.length - 1);
		}
	}
}
function rbChangeCmb(cmbId, value) {
	var cmb = document.getElementById(cmbId);
	var ix = cmb.options[cmb.selectedIndex];
	ix.value = value;
}
function txtSetValue(txtId, value) {
	var txt = document.getElementById(txtId);
	txt.value = value;
}
function cmbToHidden(id, sign) {
	var cmb = document.getElementById(id);
	var hidden = document.getElementById(id + "_hidden");
	hidden.value = "";
	for (var i = 0; i < cmb.options.length; i++) {
		if (sign != "") {
			hidden.value += cmb.options[i].text + sign;
		}
		hidden.value += cmb.options[i].value;
		if (i < cmb.options.length - 1) {
			hidden.value += "|";
		}
	}
}

function txtAutoComplete(txtId, page) {
	var keyword = $("#" + txtId).val();
	if (keyword.length > 0) {
		$.ajax({
			type: "POST",
			url: page,
			data: { keyword: keyword, txtId: txtId }
		}).done(function(html) {
			if (html != "") {
				$("#" + txtId + "_ac").html(html);
				$("#" + txtId + "_ac").css("display", "block");
			} else {
				hideAutoComplete(txtId);
			}
		});
	} else {
		hideAutoComplete(txtId);
	}
}

function hideAutoComplete(id) {
	$("#" + id + "_ac").css("display", "none");
}

function hideAutoCompleteCheck(id) {
	setTimeout(function() { hideAutoComplete(id); }, 250);
}

function addTextToId(text, id, char) {
	var div = document.getElementById(id);
	if (char == "") {
		div.value = text;
	} else {
		if (div.value != "") {
			div.value += char;
		}
		div.value += text;
	}
}
