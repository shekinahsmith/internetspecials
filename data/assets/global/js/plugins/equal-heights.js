/*
 * equalHeights()
 *
 * @desc: returns tallest height within group of specified elements
 *
 * @param {string} padding  Whether to include padding in the height calculation
 */
$.fn.equalHeights = function(padding) {

    var maxHeight = this.map(function(i, e) {

        if (padding == 'padding') {

            return $(e).outerHeight();

        } else {

            return $(e).height();
        }

    }).get();

    return this.height(Math.max.apply(this, maxHeight));
};

// package card equal height "columns"
function cardEqualHeights() {

    var $card = $('.js-card');
    var $header = $('.js-card-header');
    var $price = $('.js-card-price');
    var $info = $('.js-card-info');

    // get outta here
    if (!$card.length)
        return;

    $header.equalHeights();
    // $price.equalHeights();
    // $info.equalHeights();
    $card.equalHeights();
    // $($card).height(function (index, height) {
    //     return (height + 40);
    // });
}

