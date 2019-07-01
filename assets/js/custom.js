'use strict';

var swalInfo = function(paramTitle,paramType,paramText,paramTimer = 1000) {
	return Swal.fire({
		title: paramTitle,
		type: paramType,
		text: paramText,
		timer: paramTimer,
		showCancelButton: false,
		showConfirmButton: false,
		allowOutsideClick : false,
	});
}