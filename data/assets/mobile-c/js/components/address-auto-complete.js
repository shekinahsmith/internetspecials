/*
* addressAutoComplete()
*
* @desc: added autocomplete function to allow for the city
* and state to be pre-filled based on the zip code.
* Also, added street address autocomplete.
*
*/
function addressAutoComplete() {

	$('[data-autocomplete="zip"]').each(function() {

		var $this = $(this);

		$this.focusout(function(){

			var zipCode = $this.val();
			if(!jQuery.isEmptyObject(zipCode)){

				$.ajax({
					url: "/webshared/ds/ajax/city_search.php?zip=" + zipCode
				})
				.success(function( data ){

					var location = JSON.parse(data);

					$('[data-autocomplete="city"]').val(location.City);
					$('[data-autocomplete="state"]').val(location.StateAbbrev);
				});
			}
		});
	});

}

module.exports = addressAutoComplete;
