$(document).on('ready', function () {

    smartyStreetInit = function () {

        var street = '[data-autocomplete="street"]';
        var city = '[data-autocomplete="city"]';
        var state = '[data-autocomplete="state"]';
        var zip = '[data-autocomplete="zip"]';

        // smarty streets autocompletion
        var ss = $.LiveAddress({
            key: "5559207608041521",
            autoVerify: false,
            target: "US",
            addresses: [{
                address1: street,
                locality: city,
                administrative_area: state,
                //postal_code: zip
            }]
        });
        
        return ss;
    };

});

