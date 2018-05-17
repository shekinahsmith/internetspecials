
$(document).on('ready', function () {
    
   // auto pop on first page view
	if (!Cookies.get('addressCheckModal')) {
		$('.js-modal--address-check[data-modal-autopop]').plumModal({
			autoPop : true
		});
		document.cookie = 'addressCheckModal = ' + 1;
	}

});  