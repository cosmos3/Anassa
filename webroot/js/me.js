
imageNr = 0;
imageMax = 3;
delay = 3000;
transSteps = 20;
var transTmr;
addEvent(window, "load", showSlides);
addEvent(window, "beforeunload", meRemove);

function meRemove() {
	removeEvent(window, "load", showSlides);
	removeEvent(window, "beforeunload", meRemove);
}

function showSlides(e) {
	div_Slide = document.getElementById("slides");
	nextImage(0);
}

function nextImage(nr) {
	clearTimeout(transTmr);
	div_Slide.style.opacity = 0;
	imageNr = nr;
	imageNr++;
	if (imageNr > imageMax) {
		imageNr = 1;
	}
	div_Slide.style.backgroundImage = "url('img/me/me_slide_" + imageNr + ".jpg')";
	transStep = 0;
	transTmr = setTimeout("slideIn()", transSteps);
}

function slideOut() {
	var opacity = transStep / transSteps;
	div_Slide.style.opacity = "" + (1 - opacity);
	div_Slide.style.filter = "alpha(opacity=" + (100 - opacity * 100) + ")";
	if (++transStep <= transSteps) {
		transTmr = setTimeout("slideOut()", transSteps);
	} else {
		clearTimeout(transTmr);
		nextImage(imageNr);
	}
}

function slideIn() {
	var opacity = transStep / transSteps;
	div_Slide.style.opacity = "" + opacity;
	div_Slide.style.filter = "alpha(opacity=" + (opacity * 100) + ")";
	if (++transStep <= transSteps) {
		transTmr = setTimeout("slideIn()", transSteps);
	} else {
		transStep = 0;
		transTmr = setTimeout("slideOut()", delay);
	}
}
