// Vue
import Vue from 'vue/dist/vue.min.js'
import vueSlider from 'vue-slider-component'
import {
    FormWizard,
    TabContent
} from 'vue-form-wizard'
import getGrade from './get-grade.js'
import VTooltip from 'v-tooltip'
Vue.use(VTooltip)

// steps
const rtStart = 0;
const rtUsers = 1;
const rtUsage = 2;
const rtTV = 3;
const rtChannels = 4;
const rtResult = 5;

// design flags
const cardsStyle = false; //seems like an easy way to switch designs


var productRecToolInit = function () {

    // user score based on selections based on {{counter}} value
    let total = '';

    var productRec = new Vue({
        el: ".product-rec",
        computed: {
            // step 3 ready
            step3Ready: function () {
                for (let b in this.buttonUse) {
                    if (this.buttonUse[b].active) return true;
                }
                return false;
            },
            // step 5 ready
            step5Ready: function () {
                for (let b in this.buttonChannels) {
                    if (this.buttonChannels[b].active) return true;
                }
                return false;
            },
            getGrade: function () {
                return [this.counter].map(getGrade)[0]
            }
        },

        created: function () {
            $(".js-loader").fadeOut("normal", function () {
                $(this).remove();
            });
        },

        methods: {

            // get user count
            getUserCount: function () {
                // if there are 4 or more users, add 1 point
                if (this.userCount.value >= 4) {
                    this.counter++;
                }
            },

            // usage buttons
            toggleActiveUse: function (index) {

                // total points
                let counterTotal = parseInt(this.counter);
                let usagePts = parseInt(this.buttonUse[index].points);

                //toggle active state
                this.buttonUse[index].active = !this.buttonUse[index].active;

                if (this.buttonUse[index].active) {
                    hQ.storeLast(this.buttonUse[index].name + '|IntUsage|Picker', {});
                    ga('send', 'event', 'Picker', 'IntUsage', this.buttonUse[index].name);
                }

                // add value if active and has a point value
                if (this.buttonUse[index].active && this.buttonUse[index].points > 0) {
                    this.counter = counterTotal + usagePts;
                    // remove value if inactive and has a point value
                } else if (this.buttonUse[index].active === false && this.buttonUse[index].points > 0) {
                    this.counter = counterTotal - usagePts;
                }
            },

            // tv optional buttons
            toggleActiveTV: function (index) {

                // total points
                let counterTotal = parseInt(this.counter);
                let tvPts = parseInt(this.buttonTV[index].points);

                this.buttonTV[index].active = !this.buttonTV[index].active;

                // user has selected they want DIRECTV
                if (this.buttonTV[index].active && this.buttonTV[index].points > 0) {
                    // proceed to channel selection
                    this.goToNextStep();
                    this.counter = counterTotal + tvPts;

                    hQ.storeLast(this.buttonTV[index].tracking + '|TV|Picker', {});
                    ga('send', 'event', 'Picker', 'TV', this.buttonTV[index].tracking);
                    // internet only result
                } else if (this.buttonTV[index].active === false && this.buttonTV[index].points > 0) {
                    this.counter = counterTotal - tvPts;
                } else {
                    // go to results
                    this.$refs.help.changeTab(rtTV, rtResult);

                    // once you get to results ensure progress bar is at 100%
                    this.progressBar();
                    this.updateTabMargin();
                    this.updateStackedCards();

                    hQ.storeLast(this.buttonTV[index].tracking + '|TV|Picker', {});
                    ga('send', 'event', 'Picker', 'TV', this.buttonTV[index].tracking);

                }
            },

            toggleActiveChannels: function (index) {

                let counterTotal = parseInt(this.counter);
                let channelPts = parseInt(this.buttonChannels[index].points);

                this.buttonChannels[index].active = !this.buttonChannels[index].active;

                if (this.buttonChannels[index].active) {
                    hQ.storeLast(this.buttonChannels[index].name + '|Channels|Picker', {});
                    ga('send', 'event', 'Picker', 'Channels', this.buttonChannels[index].name);
                }

                // add value if active and has a point value
                if (this.buttonChannels[index].active && this.buttonChannels[index].points > 0) {
                    this.counter = counterTotal + channelPts;
                    // remove value if inactive and has a point value
                } else if (this.buttonChannels[index].active === false && this.buttonChannels[index].points > 0) {
                    this.counter = counterTotal - channelPts;
                }
            },

            goToNextStep: function () {

                this.$refs.help.nextTab();

                // on results step ensure progress bar is 100%
                if (this.$refs.help.activeTabIndex === rtResult) {
                    this.progressBar();
                }
                this.updateTabMargin();
                this.appendStackedCard();
                setTimeout(this.updateStackedCards, 30);

            },

            goToPrevStep: function () {
                this.$refs.help.prevTab();
            },

            goToEditSelections: function () {
                if (this.counter <= 100) {
                    this.$refs.help.changeTab(rtResult, rtTV);
                } else {
                    this.goToPrevStep();
                }
            },

            goToFinish: function () {
                this.$refs.help.finish();
            },

            progressBar: function () {

                // ensuring the progress bar is at 100% on the last step
                return this.$refs.help.progressBarStyle['width'] = '100%';
            },

            updateTabMargin: function () {

                // on tab with feature list - margin on bottom of tabs needs to be increased to fit list
                setTimeout(function () {

                    if ($('.product-rec .tab-content__features').length && cardsStyle === true) {
                        $('.product-rec .tab-content').css('margin-bottom', 155);
                    } else {
                        $('.product-rec .tab-content').css('margin-bottom', 0);
                    }

                }, 30);
            },

            appendStackedCard: function() {
                // needed to re-add "parent" card on restart to allow for updateStackedCards() to work

                if (!$('.js-product-rec__card').length && cardsStyle === true) {
                    $('.product-rec .tab-content').append('<div class="product-rec__card js-product-rec__card"></div>');
                }
            },

            updateStackedCards: function () {

                $('.js-product-rec__card').css('visibility', 'visible');

                // creating stacked cards base on the number tabs
                let activeTabIndex = this.$refs.help.activeTabIndex;
                let tabCount = this.$refs.help.tabs.length;
                let cardCount = (tabCount - 2) - activeTabIndex;

                // utilizing first because without it the clone will clone the two cards from first step
                let card = $('.js-product-rec__card').first().clone();
                $('.js-product-rec__card').remove();

                for (var i = 0; i < cardCount; i++) {
                    card.clone().appendTo('.product-rec .tab-content');
                }

            },

            trackingGetStarted: function () {
                hQ.storeLast('Get Started|CTA|Picker', {});
                ga('send', 'event', 'Picker', 'CTA', 'Get Started');
            },

            trackingUserCnt: function () {
                hQ.storeLast('People Cnt|CTA|Picker', {});
                ga('send', 'event', 'Picker', 'CTA', 'People Cnt');
            },

            trackingIntUsage: function () {
                hQ.storeLast('Int Usage|CTA|Picker', {});
                ga('send', 'event', 'Picker', 'CTA', 'Int Usage');
            },

            trackingChannels: function () {
                hQ.storeLast('Channels|CTA|Picker', {});
                ga('send', 'event', 'Picker', 'CTA', 'Channels');
            },

            trackingResultOrder: function () {
                hQ.storeLast('Order|Result|Picker', {});
                ga('send', 'event', 'Picker', 'Result', 'Order');
            },

            trackingResultAll: function (grade) {
                hQ.storeLast('View All|'+ grade +'|Picker', {});
                ga('send', 'event', 'Picker', grade, 'View All');
            }

        },

        mounted: function () {

            // hide original "stacked card" used for cloning on load
            $('.js-product-rec__card').css('visibility', 'hidden');

        },

        components: {
            FormWizard,
            TabContent,
            vueSlider
        },

        data: {

            tooltip: 'test',

            groupId: null,

            // initial slider value
            userCount: {
                value: 1
            },
            // hide slider ticks
            piecewiseStyle: {
                display: "none"
            },

            // show current points
            counter: 0,

            // Speed decision based on internet usage
            buttonUse: [{
                    name: "Email",
                    icon: '<svg class="icon icon-linear--email" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><title>icon-linear/email</title><path d="M18.456 16.967c1.396 0 2.346.993 2.403 2.446h-5.093c.215-1.424 1.28-2.446 2.69-2.446m.087 6.49c1.151 0 1.985-.431 2.402-.85.303-.301.433-.59.433-.733 0-.331-.359-.432-.403-.403-.345.677-1.007 1.367-2.432 1.367-1.64 0-2.777-1.151-2.806-2.835h5.54c.216 0 .302-.043.302-.244v-.072c0-1.986-1.252-3.324-3.123-3.324-1.956 0-3.396 1.54-3.396 3.568 0 2.044 1.397 3.526 3.483 3.526m12.118 7.582H6.175a1.427 1.427 0 0 1-1.425-1.425v-10.95l12.094 8.41a2.683 2.683 0 0 0 3.142.005l12.158-8.31v10.845c0 .772-.679 1.425-1.483 1.425M5.592 14.207l11.751-8.11a1.885 1.885 0 0 1 2.214.004l11.75 8.109c.524.353.837.936.837 1.562v2.089l-4.348 2.972V14.71c0-.646-.526-1.171-1.17-1.171H10.216c-.646 0-1.17.525-1.17 1.17v3.68a.375.375 0 0 0 .75 0v-3.68c0-.231.188-.42.42-.42h16.408c.232 0 .421.189.421.42v6.636l-7.489 5.12a1.963 1.963 0 0 1-2.28-.003L4.75 17.752v-1.98c0-.625.313-1.208.842-1.565m26.136-.616l-11.74-8.102a2.675 2.675 0 0 0-3.077-.004L5.17 13.588A2.63 2.63 0 0 0 4 15.772v13.842c0 1.199.976 2.175 2.175 2.175h24.486c1.21 0 2.233-.996 2.233-2.175V15.772c0-.876-.437-1.692-1.166-2.181" fill="#009FDB" fill-rule="evenodd"/></svg>',
                    active: false,
                    points: 0
                },
                {
                    name: "Browsing",
                    icon: '<svg class="icon icon-linear--internet" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><title>icon-linear/internet</title><path d="M33.091 26.304l-2.699 3.13a.431.431 0 0 1-.142.107.946.946 0 0 1-.13.023l-.028.001a.392.392 0 0 1-.252-.097l-4.025-3.42-1.594 1.844a.36.36 0 0 1-.359.131.368.368 0 0 1-.206-.112.662.662 0 0 1-.083-.102l-2.792-8.883a.38.38 0 0 1-.022-.224.395.395 0 0 1 .384-.303c.031 0 .061.004.119.015l9.145 1.426c.177.04.254.166.285.251a.4.4 0 0 1-.076.383l-1.605 1.848 4.034 3.427a.38.38 0 0 1 .136.278.368.368 0 0 1-.09.277zm.438-1.127l-3.455-2.935 1.11-1.278c.261-.305.344-.715.219-1.113a1.15 1.15 0 0 0-.853-.747l-9.147-1.425a1.157 1.157 0 0 0-1.375.86c-.05.236-.026.483.053.653l2.787 8.871c.055.134.137.255.254.375a1.131 1.131 0 0 0 1.668-.058l1.107-1.28 3.456 2.938a1.13 1.13 0 0 0 .829.272c.105-.008.194-.027.291-.052l.055-.02c.178-.079.327-.188.436-.32l2.698-3.129c.2-.237.294-.533.267-.822a1.13 1.13 0 0 0-.4-.79zM7.742 28.362a14.644 14.644 0 0 1 3.677-2.765c.898 3.31 2.346 5.787 4.072 7.091a14.67 14.67 0 0 1-7.749-4.326zm2.753-9.552h.011c.007.444.017.886.042 1.322.011.183.032.36.046.542.029.374.057.748.1 1.116.026.22.063.435.093.652.047.324.089.65.146.967.041.228.092.45.137.674.052.251.098.506.155.753A15.402 15.402 0 0 0 7.226 27.8a14.598 14.598 0 0 1-3.463-8.99h6.732zM7.539 8.57a14.68 14.68 0 0 1 7.954-4.532c-1.712 1.292-3.151 3.74-4.05 7.004a14.92 14.92 0 0 1-1.69-1.03.375.375 0 0 0-.435.61c.613.437 1.266.825 1.937 1.17a26.03 26.03 0 0 0-.289 1.327c-.036.193-.06.39-.091.584-.058.357-.119.714-.164 1.077-.028.23-.043.461-.066.691-.033.336-.069.671-.09 1.011-.016.244-.02.493-.028.74-.011.28-.03.557-.033.838H3.753a14.579 14.579 0 0 1 3.786-9.49zm21.342-.324a14.578 14.578 0 0 1-3.614 2.74c-.902-3.237-2.344-5.668-4.056-6.953a14.615 14.615 0 0 1 7.67 4.213zM18.068 23.12a15.277 15.277 0 0 0-6.142 1.376 24.29 24.29 0 0 1-.133-.62c-.045-.22-.093-.44-.132-.664-.052-.299-.093-.602-.136-.907-.031-.216-.066-.43-.091-.65a30.904 30.904 0 0 1-.091-1.02c-.015-.192-.036-.382-.048-.576a30.148 30.148 0 0 1-.038-1.249h6.811v4.31zm0 9.834c-2.469-.22-4.768-3.183-5.963-7.708a14.527 14.527 0 0 1 5.963-1.37v9.078zm0-20.207a14.532 14.532 0 0 1-5.94-1.359c1.201-4.469 3.49-7.397 5.94-7.616v8.975zm.75-8.954c2.407.32 4.577 3.151 5.766 7.548a14.503 14.503 0 0 1-5.766 1.395V3.793zm-7.542 13.45c.009-.238.012-.478.027-.713.021-.338.057-.67.09-1.004.021-.217.036-.435.062-.65.046-.369.109-.73.166-1.093.029-.174.05-.35.081-.522.072-.382.16-.756.247-1.13a15.285 15.285 0 0 0 6.119 1.366v4.563h-6.816c.003-.274.014-.546.024-.818zm15.278 13.211a14.504 14.504 0 0 1-5.584 2.277 9.125 9.125 0 0 0 1.908-1.86.374.374 0 1 0-.594-.459c-1.052 1.365-2.37 2.311-3.466 2.516v-9.04c.182.005.366.008.546.021h.027a.375.375 0 0 0 .027-.749c-.2-.013-.4-.023-.6-.03v-9.643a15.242 15.242 0 0 0 5.952-1.406c.302 1.283.516 2.632.625 4.026a.374.374 0 0 0 .373.346h.03a.376.376 0 0 0 .345-.404 27.201 27.201 0 0 0-.684-4.312 15.397 15.397 0 0 0 3.928-2.936 14.561 14.561 0 0 1 3.588 9.576l-.002.056a14.795 14.795 0 0 1-.29 2.825.376.376 0 0 0 .735.148c.196-.969.299-1.968.306-2.984l.002-.059c0-3.997-1.545-7.646-4.067-10.385l-.001-.002a15.33 15.33 0 0 0-10.834-4.96v-.002l-.111-.002c-.09-.002-.179-.008-.268-.008h-.003L18.388 3v.001h-.026c-.066 0-.131.003-.198.004l-.096.001v.002A15.386 15.386 0 0 0 6.984 8.066 15.317 15.317 0 0 0 3 18.363l.003.447h.01a15.342 15.342 0 0 0 3.923 9.797v.001l.003.001.272.305.007-.008a15.374 15.374 0 0 0 10.85 4.812V33.727l.135-.003h.069l.09.002.456-.007v-.012a15.265 15.265 0 0 0 8.158-2.632.374.374 0 0 0 .098-.52.374.374 0 0 0-.52-.1z" fill="#009FDB" fill-rule="evenodd"/></svg>',
                    active: false,
                    points: 0
                },
                {
                    name: "Streaming",
                    icon: '<svg class="icon icon-linear--on-demand" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><title>icon-linear/on-demand</title><path d="M16.041 20.056a.058.058 0 0 0-.032.01c-.02.011-.046.03-.045.062v5.826c0 .027.015.053.037.067.043.024.072.01.081.004l5.55-2.912c.02-.01.034-.025.038-.044a.086.086 0 0 0-.006-.065l-5.585-2.938a.085.085 0 0 0-.038-.01zm.006 6.728a.835.835 0 0 1-.833-.827v-5.815a.813.813 0 0 1 .403-.716.806.806 0 0 1 .808-.025l5.55 2.906a.829.829 0 0 1 .004 1.471l-5.546 2.91a.822.822 0 0 1-.386.096zm-10.502-13.9L9.9 11.746l-2.157 3.632-2.478.647-.48-1.842a1.067 1.067 0 0 1 .76-1.299zm9.889-2.584l-2.159 3.632-4.5 1.176 2.157-3.632 4.502-1.176zm5.531-1.446l-2.157 3.633-4.5 1.175 2.157-3.632 4.5-1.176zM26.5 7.408l-2.159 3.633-4.5 1.176 2.157-3.633L26.5 7.408zm2.384-.623a1.072 1.072 0 0 1 1.299.761l.48 1.843-5.29 1.382 2.159-3.632 1.352-.354zm3.152 8.643H10.52l20.695-5.408c.2-.052.32-.257.268-.458l-.576-2.205a1.805 1.805 0 0 0-.838-1.106 1.802 1.802 0 0 0-1.375-.192l-23.337 6.1a1.818 1.818 0 0 0-1.298 2.213l.577 2.205c.005.021.016.038.024.057v9.985a.374.374 0 1 0 .75 0v-9.856l2.25-.588c.006 0 .01.003.016.003H31.66v12.684c0 .588-.477 1.065-1.066 1.065H6.476a.375.375 0 0 0 0 .75h24.12a1.818 1.818 0 0 0 1.816-1.815V15.803a.375.375 0 0 0-.376-.375z" fill="#009FDB" fill-rule="evenodd"/></svg>',
                    active: false,
                    points: 1
                },
                {
                    name: "Gaming",
                    icon: '<svg class="icon icon-linear--games" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><title>icon-linear/games</title><path d="M22.676 11.9a1.176 1.176 0 1 0 1.179 1.177 1.18 1.18 0 0 0-1.179-1.177zm0 3.101a1.926 1.926 0 1 1 .004-3.852A1.926 1.926 0 0 1 22.676 15zm-2.44 3.539c1.415.085 2.325.404 3.737 1.993l5.043 5.645c.29.305.688.478 1.114.478.86 0 1.56-.697 1.56-1.555v-.024c-.029-.516-.853-7.216-1.408-11.647l-.001-.015c-.237-2.834-2.057-4.665-4.635-4.665H9.794c-2.578 0-4.398 1.831-4.635 4.665-.555 4.446-1.38 11.146-1.409 11.662v.024c0 .858.7 1.555 1.56 1.555a1.54 1.54 0 0 0 1.122-.486l5.036-5.638c1.411-1.588 2.322-1.907 3.713-1.992h5.055zm9.894 8.866a2.277 2.277 0 0 1-1.665-.72l-5.052-5.654c-1.253-1.41-1.969-1.668-3.2-1.743l-5.009.001c-1.208.074-1.924.332-3.176 1.741l-5.045 5.647a2.287 2.287 0 0 1-1.673.728A2.31 2.31 0 0 1 3 25.101h.006c.011-.327.183-1.973 1.408-11.764C4.679 10.15 6.843 8 9.794 8h15.852c2.949 0 5.111 2.148 5.382 5.344 1.223 9.784 1.395 11.43 1.406 11.757h.006a2.31 2.31 0 0 1-2.31 2.305zM13.903 14.038h-2.508V11.53a.375.375 0 0 0-.75 0v2.508H8.138a.375.375 0 0 0 0 .75h2.507v2.508a.375.375 0 0 0 .75 0v-2.508h2.508a.375.375 0 0 0 0-.75zm12.589 1.674c-.65 0-1.179.526-1.179 1.174a1.178 1.178 0 0 0 2.355 0c0-.648-.528-1.174-1.176-1.174zm0 3.099a1.93 1.93 0 0 1-1.929-1.925 1.928 1.928 0 0 1 3.855 0 1.928 1.928 0 0 1-1.926 1.925z" fill="#009FDB" fill-rule="evenodd"/></svg>',
                    active: false,
                    points: 1
                }
            ],
            // does the user want DIRECTV? go to channel selection if so
            buttonTV: [{
                    name: "Yes",
                    icon: '<img class="icon icon-flat--check" src="/webshared/atv/icons/dist/svg/icon-flat/check.svg" alt="icon">',
                    active: false,
                    points: 100,
                    tracking: 'Yes'
                },
                {
                    name: "No",
                    icon: '<img class="icon icon-flat--error" src="/assets/mobile-c/images/icon-error-red.svg" alt="icon">',
                    active: false,
                    points: 0,
                    tracking: 'No'
                }
            ],
            // channel picker
            buttonChannels: [{
                    name: "Local channels",
                    channels: 'ABC, CBS, NBC, FOX',
                    active: false,
                    points: 0
                },
                {
                    name: "Basic sports",
                    channels: 'ESPN, NBCSports, FS1',
                    active: false,
                    points: 10
                },
                {
                    name: "Entertainment",
                    channels: 'E!, Bravo, Oxygen',
                    active: false,
                    points: 0
                },
                {
                    name: "Home",
                    channels: 'HGTV, DIY',
                    active: false,
                    points: 0
                },
                {
                    name: "Movies",
                    channels: 'AMC, FX, USA',
                    active: false,
                    points: 0
                },
                {
                    name: "Spanish",
                    channels: 'Univision, Telemundo',
                    active: false,
                    points: 0
                },
                {
                    name: "Premiums",
                    channels: 'HBO, Showtime',
                    active: false,
                    points: 0
                },
                {
                    name: "Premium Sports",
                    channels: 'NFL SUNDAY TICKET',
                    active: false,
                    points: 20
                }
            ]
        }
    });

};

export default productRecToolInit;