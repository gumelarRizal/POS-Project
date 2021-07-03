/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

function validatenumber(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	var regex = /^[0-9\b]+$/; // allow only numbers [0-9]
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
}
function set_mask() {
	$(".number-mask").inputmask("decimal", {
		radixPoint: ".",
		autoGroup: true,
		groupSeparator: ",",
		groupSize: 3,
		rightAlignNumerics: true,
		oncleared: function () {
			$(this).val("0");
		},
	});
}
function set_mask2() {
	$(".number-mask").inputmask("decimal", {
		radixPoint: ",",
		autoGroup: true,
		groupSeparator: ".",
		groupSize: 3,
		rightAlignNumerics: true,
		oncleared: function () {
			$(this).val("0");
		},
	});
}