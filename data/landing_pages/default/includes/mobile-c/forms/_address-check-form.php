<form class="address-check-form js-address-check-form" action="/zip_check_post2.php" method="post">

	<input type="hidden" name="redirect" value="<?= $_SERVER["SCRIPT_NAME"] ?>">

	<h4 class="form-subline">Enter your address for expedited service when you call.</h4>
	<!-- /.form-subline -->

    <? if( !empty($_SESSION['form_rmsg']) ) { ?>

        <div class="errors">
            <?
            print $_SESSION['form_rmsg'];
            unset($_SESSION['form_rmsg']);
            unset($_SESSION['bad_fields']);
            ?>
        </div>

    <? } ?>

	<input type="text" name="AvailabilityZipCode" class="zip" id="zip" pattern="^\d{5,6}(?:[-\s]\d{4})?$" value="<? echo (isset($_SESSION['submission']['zip'])) ? $_SESSION['submission']['zip']: ''; ?>"required placeholder="ZIP Code">
    <!-- /.zip -->

	<input type="text" name="city" class="city" id="city" value="<? echo (isset($_SESSION['submission']['city'])) ? $_SESSION['submission']['city']: ''; ?>" required placeholder="City">
    <!-- /.city -->

	<select  name="state" class="state" id="state" value="<? echo (isset($_SESSION['submission']['state'])) ? $_SESSION['submission']['state']: ''; ?>" required placeholder="State">
		<option value="">State</option>
		<option value="AL">AL</option>
		<option value="AK">AK</option>
		<option value="AZ">AZ</option>
		<option value="AR">AR</option>
		<option value="CA">CA</option>
		<option value="CO">CO</option>
		<option value="CT">CT</option>
		<option value="DE">DE</option>
		<option value="DC">DC</option>
		<option value="FL">FL</option>
		<option value="GA">GA</option>
		<option value="HI">HI</option>
		<option value="ID">ID</option>
		<option value="IL">IL</option>
		<option value="IN">IN</option>
		<option value="IA">IA</option>
		<option value="KS">KS</option>
		<option value="KY">KY</option>
		<option value="LA">LA</option>
		<option value="ME">ME</option>
		<option value="MD">MD</option>
		<option value="MA">MA</option>
		<option value="MI">MI</option>
		<option value="MN">MN</option>
		<option value="MS">MS</option>
		<option value="MO">MO</option>
		<option value="MT">MT</option>
		<option value="NE">NE</option>
		<option value="NV">NV</option>
		<option value="NH">NH</option>
		<option value="NJ">NJ</option>
		<option value="NM">NM</option>
		<option value="NY">NY</option>
		<option value="NC">NC</option>
		<option value="ND">ND</option>
		<option value="OH">OH</option>
		<option value="OK">OK</option>
		<option value="OR">OR</option>
		<option value="PA">PA</option>
		<option value="RI">RI</option>
		<option value="SC">SC</option>
		<option value="SD">SD</option>
		<option value="TN">TN</option>
		<option value="TX">TX</option>
		<option value="UT">UT</option>
		<option value="VT">VT</option>
		<option value="VA">VA</option>
		<option value="WA">WA</option>
		<option value="WV">WV</option>
		<option value="WI">WI</option>
		<option value="WY">WY</option>
	</select>

	<input type="text" name="street" class="street" id="street" value="<? echo (isset($_SESSION['submission']['street'])) ? $_SESSION['submission']['street']: ''; ?>" placeholder="Enter your street address" required>
	<!-- /.street -->

	<select name="unitType" class="unit-type" id="unit_type" value="<? echo (isset($_SESSION['submission']['unitType'])) ? $_SESSION['submission']['unitType']: ''; ?>" required placeholder="Unit Type">
		<option value="">Unit Type</option>
		<option value="NONE">House</option>
		<option value="APT">Apartment</option>
	</select>
	<!-- /.unit-type -->

	<input type="text" name="unitValue" class="unit" id="unit" value="<? echo (isset($_SESSION['submission']['unitValue'])) ? $_SESSION['submission']['unitValue']: ''; ?>" placeholder="Unit Number">
	<!-- /.unit -->
	<br>
    
	<div class="spin-wrapper">
		<input type="submit" class="availability-submit js-availability-submit js-hailo" data-hailo-event="address_check_availability" value="Check Availability">
	</div>
	<!-- /.spin-wrapper -->

</form>
<!-- /.address-check-form -->

<script>
        $(function(){
            $("#zip").focusout(function(){
            	var zipCode = $("#zip").val();
            	if(!jQuery.isEmptyObject(zipCode)){
                	$.ajax({
                    	url: "/webshared/att/ajax/city_search.php?zip=" + zipCode
                	})
                	.success(function( data ){
                    	var location = JSON.parse(data);
                    	$("#city").val(location.City);
                    	$("#state").val(location.StateAbbrev);
                	});
            	}
            });
        });

        $(function(){
            var url = "webshared/att/ajax/autocomplete.php";
            var zip = $("#zip");
            $("#street").autocomplete({
                source: function(req, res){
                    $.getJSON(url, {address:req.term, zip: zip.val()}, function( data ){
                        var suggestions = [];
                        for(i=0; i<data.streets.length; i++){
                            data.streets[i].value = data.streets[i].street;
                            suggestions[i] = data.streets[i];
                        }
                        res(suggestions);
                    });
                },
                minLength: 4
            });
        });
</script>
