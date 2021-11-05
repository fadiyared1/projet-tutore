document.querySelectorAll(".__range-step").forEach(function (ctrl) {
	var el = ctrl.querySelector('input');
	var output = ctrl.querySelector('output');
	var newPoint, newPlace, offset;
	el.oninput = function () {

		var allOptions = ctrl.querySelectorAll("option");

		// colorize step options
		allOptions.forEach(function (opt) {
			if (opt.value <= el.valueAsNumber)
				opt.style.backgroundColor = 'green';
			else
				opt.style.backgroundColor = '#aaa';

		});
		// colorize before and after
		var valPercent = (el.valueAsNumber - parseInt(el.min)) / (parseInt(el.max) - parseInt(el.min));
		var style = 'background-image: -webkit-gradient(linear, 0% 0%, 100% 0%, color-stop(' +
			valPercent + ', green), color-stop(' +
			valPercent + ', #aaa));';
		el.style = style;

		// Popup
		if ((' ' + ctrl.className + ' ').indexOf(' ' + '__range-step-popup' + ' ') > -1) {
			var selectedOpt = ctrl.querySelector('option[value="' + el.value + '"]');
			output.innerText = selectedOpt.text;
			output.style.left = "50%";
			output.style.left = ((selectedOpt.offsetLeft + selectedOpt.offsetWidth / 2) - output.offsetWidth / 2) + 'px';
		}

		var dataList = ctrl.querySelector('datalist');
		var currentSelectedOption = ctrl.querySelectorAll("option")[el.valueAsNumber - 1]
		console.log(currentSelectedOption);
		console.log(dataList);

		jQuery.ajax({
			url: personalizedSupport.ajaxUrl,
			data: {
				'action': personalizedSupport.sendFeedback,
				'dataset': dataList.dataset,
				'nonce': personalizedSupport.nonce
			},
			success: function (data) {
				// This outputs the result of the ajax request
				console.log(data);
			},
			error: function (errorThrown) {
				console.log(errorThrown);
			}
		});
	};
	el.oninput();
});

window.onresize = function () {
	document.querySelectorAll(".__range").forEach(function (ctrl) {
		var el = ctrl.querySelector('input');
		el.oninput();
	});
};