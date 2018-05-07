import addressCheckModal from "./components/address-check-modal.js"
import productRecTool from "./components/product-rec.js"

if (window.location.href.indexOf('help') > -1) {

	$(window).load(function () {
		productRecTool();
	});
}
;

/*
** I'll take full blame for this hack. Did it to allow the vue component to init'd both on auto modal pop and if directly triggered by clicking a button
 */
var hasAddressCheckModalInit = false;
// // invoking address check vue app once modal is visible
$(document).one('plumAutoModalShow', function () {
	addressCheckModal();
	hasAddressCheckModalInit = true;
});

$(document).one('plumModalShow', function () {
	if (hasAddressCheckModalInit !== true) {
		addressCheckModal();
	}
});
