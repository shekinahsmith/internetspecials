import Vue from 'vue/dist/vue.min.js';
import { FormWizard, TabContent } from 'vue-form-wizard';
import Vuelidate from 'vuelidate';
import axios from 'axios';
import VueAxios from 'vue-axios';
import lodash from 'lodash';
import VueLodash from 'vue-lodash/dist/vue-lodash.min';

import smartyStreets from '../../../global/js/plugins/jquery.liveaddress.js';

Vue.use(VueLodash, lodash);
Vue.use(VueAxios, axios);
Vue.use(Vuelidate);

import { required, minLength, maxLength, requiredIf } from 'vuelidate/lib/validators';

var addressCheckInit = function() {

    var addressCheck = new Vue({
        el: '.address-check',
        components: {
            smartyStreets,
            FormWizard,
            TabContent
        },
        data: {
            street: '',
            unitType: false,
            unit: '',
            city: '',
            state: '',
            zip: '',
            NONE: '',
            APT: '',
            isServiceable: '',
            ss: null,
            loaderShow: false
        },
        validations: {
            zip: {
                required,
                maxLength: minLength(5)
            },
            street: {
                required
            },
            unitType: {
                //required
            },
            unit: {
                required : function(unitType) {
                	if(unitType){
                		return true;
	                }
	                return false;
		        }
            }
        },
        watch: {
            // gets value in zip field and runs zip lookup
            zip: function() {
                this.city = '';
                if(!this.$v.zip.$invalid) {
                    this.lookupZip();
                }
            },
            street: function() {
                const self = this;
                self.ss.verify();
            }
        },
        computed: {

            unitNumberShow: function() {

                const self = this;

                if( self.unitType === true ) {
                    return true;
                }else {
                    return false;
                }
            }
        },
        methods: {
            // advances to next step from zip check step
            nextStepZip: function() {

                if( !this.$v.zip.$invalid ) {
                    this.$refs.addressCheck.nextTab();
                }
                else {
                    // checks if input field is valid
                    this.$v.zip.$touch()
                }
            },
            // looks up zip and outputs the corresponding city and zip based on zip
            lookupZip: _.debounce(function() {

                // ensuring that "this" references the vue instance and not the axios instance
                var self = this;

                axios.get('/webshared/ds/ajax/city_search.php?zip=' + self.zip)
                    .then(function(response) {
                        self.city = response.data.City;
                        self.state = response.data.StateAbbrev;
                    })
                    .catch(function(error) {
                        self.city = 'Invalid Zipcode';
                    });
            }, 500),
            // takes user back to first step to allow for updating the zip
            changeZip: function() {
                this.$refs.addressCheck.prevTab();
            },
	        // gathering form data and sending to rope for serviceable response
	        nextStepServiceability: function () {

		        // if unitType is true then require street && unit number
		        if (this.unitType) {
			        if (!this.$v.street.$invalid && !this.$v.unit.$invalid) {
				        this.loaderShow = true;
				        this.serviceabilityCheck();
			        }
			        else {
				        this.$v.street.$touch();
				        this.$v.unitType.$touch();
				        this.$v.unit.$touch();
			        }
		        // if unitType is false only require the street
		        } else {
			        if (!this.$v.street.$invalid) {
				        this.loaderShow = true;
				        this.serviceabilityCheck();
			        }
			        else {
				        this.$v.street.$touch();
				        this.$v.unitType.$touch();
				        this.$v.unit.$touch();
			        }

		        }


	        },
            serviceabilityCheck: _.debounce(function() {

                // ensuring that "this" references the vue instance and not the axios instance
                var self = this;

                let formData = new FormData();
                formData.append('street', self.street);
                formData.append('unitType', (self.unitType ? "APT" : "NONE") );
                formData.append('unitVal', self.unit);
                formData.append('city', self.city);
                formData.append('state', self.state);
                formData.append('zip', self.zip);

                // posting form data from above to rope
                axios({
                    method: 'post',
                    url: '/ajax_rope_check.php',
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    data: formData
                })
                .then(function(response) {
                    self.isServiceable = response.data.serviceable;

                    // ensuring there is a response and if so advance to next tab and update stacked cards
                    if (self.isServiceable !== '') {

                        self.loaderShow = false;
                        self.$refs.addressCheck.nextTab();
                        self.progressBar();

                        // wrapped stacked cards function in setTimeout to allow for function to get active tab index without it, it runs too quickly
                        setTimeout(self.updateStackedCards, 30);

                    }

                    document.cookie = 'userZip = ' + self.zip;
                });

            }),
            // updating the "stacked" cards based on the nubmer of tabs and active tab index
            updateStackedCards: function() {

                let activeTabIndex = this.$refs.addressCheck.activeTabIndex;
                let tabCount = this.$refs.addressCheck.tabs.length;
                let cardCount = ( tabCount - 1 ) - activeTabIndex;

                // utilizing first because without it the clone will clone the two cards from first step
                let card = $('.js-address-check__card').first().clone();
                $('.js-address-check__card').remove();

                for(var i = 0; i < cardCount; i++ ) {
                    card.clone().appendTo('.address-check .tab-content');
                }

            },
            // handlers below needed to run multiple functions on "continue" button click
            zipCheckHandler: function() {
                this.nextStepZip();
                hQ.storeLast('Zip|click|serv modal', {});
                ga('send', 'event', 'serv modal', 'click', 'Zip');
                // wrapped functions in setTimeout to allow for function to necessary data, it runs too quickly
                setTimeout(this.smartyStreetsInit, 30);
                setTimeout(this.updateStackedCards, 30);

            },
            changeZipHandler: function() {

                this.changeZip();
	            hQ.storeLast('change zip|click|serv modal', {});
                ga('send', 'event', 'serv modal', 'click', 'change zip');
                // wrapped stacked cards function in setTimeout to allow for function to get active tab index without it, it runs too quickly
                setTimeout(this.updateStackedCards, 30);
            },
            serviceabilityCheckHandler: function() {

                this.nextStepServiceability();

                hQ.storeLast('Address|click|serv modal', {});
                ga('send', 'event', 'serv modal', 'click', 'Address');

            },
            smartyStreetsInit: function() {

                const self = this;

                if ($(self.$refs.street).is(':visible')) {
                    self.ss = $.LiveAddress({
                        key: "5559207608041521",
                        autoVerify: false,
                        target: "US",
                        addresses: [{
                            address1: self.$refs.street,
                            locality: self.$refs.city,
                            administrative_area: self.$refs.state
                        }]
                    });

                    // ensuring tha the smarty streets auto complete selections stays selected
                    self.ss.on('AutocompleteUsed', function(event, data, prevHandler) {
                        self.street = data.suggestion.street_line;
                    });
                }

            },
            progressBar: function () {

                return this.$refs.addressCheck.progressBarStyle['width'] = '100%';
            },
            trackingInternet: function() {
                hQ.storeLast('Internet|Result|serv modal', {});
                ga('send', 'event', 'serv modal', 'Result', 'Internet');
            },
            trackingBundles: function() {
                hQ.storeLast('Bundles|Result|serv modal', {});
                ga('send', 'event', 'serv modal', 'Result', 'Bundles');
            },
            trackingPkgPicker: function() {
                hQ.storeLast('Pkg Picker|Result|serv modal', {});
                ga('send', 'event', 'serv modal', 'Result', 'Pkg Picker');
            },
            trackingExistingCustomers: function(){
		        hQ.storeLast('EC|click|serv modal', {});
                ga('send', 'event', 'serv modal', 'click', 'EC');
	        },
	        trackingAptCheck: function(){
		        hQ.storeLast('apt|click|serv modal', {});
                ga('send', 'event', 'serv modal', 'click', 'apt');
	        }
        },
        // creates stacked cards when vue app is initialized
        mounted: function() {

            // creating stacked cards base on the number tabs
            let tabCount = this.$refs.addressCheck.tabs.length - 1;
            let card = $('.js-address-check__card').clone();
            let stackedCard = card.clone();

            // removing "base" card used on page to create clone
            $('.js-address-check__card').remove();

            for ( let i = 0; i < tabCount; i++ ) {
                stackedCard.clone().appendTo('.address-check .tab-content');
            }
        }
    });

};

export default addressCheckInit;