$(function(){
	$(".numbers-decimal").keydown(function (event) {

		if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

		} else {
			event.preventDefault();
		}
		
		if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
			event.preventDefault();

		if($(this).val().indexOf('.') !== -1 && event.keyCode == 110)
			event.preventDefault();

	});
	$(".numbers").keydown(function (event) {

		if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) {

		} else {
			event.preventDefault();
		}

	});
})

function moneyFromatIndia(amount){
	return parseFloat(amount).toLocaleString('en-IN', {
	    maximumFractionDigits: 2,
	    style: 'currency',
	    currency: 'INR'
	});
}


    



    