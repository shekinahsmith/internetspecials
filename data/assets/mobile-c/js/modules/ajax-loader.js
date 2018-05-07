/*
 * loaderShow()
 *
 * @desc: shows a loading animation during ajax requests
 * @param string elem  Custom selector for loader
 * @param string htmlClass  Custom class to add to loader
 * @param object appendTo  Custom jQuery object to append loader to
 */
function loaderShow(elem, htmlClass, appendTo) {

    var body = $('body');
    var defaultLoader =
        '<div class="loader  js-loader">' +

        '<div class="loader__content"><img src="/webshared/ds/images/logos/dstar/logo-star.png" alt="Loading..."></div>' +

        '</div>';
    var loader = elem !== '' ? $(elem) : $(defaultLoader);
    var appendElem = appendTo !== undefined ? $(appendTo) : body;

    // go away
    if (loader.length < 1) return;

    // append loader
    appendElem.append(loader);

    loader.addClass('is-visible');

    if (htmlClass !== undefined) {

        loader.addClass(htmlClass);
    }
}


/*
 * loaderHide()
 *
 * @desc: hides loading animation
 */
function loaderHide(elem) {

    var loader = elem !== undefined ? $(elem) : $('.js-loader');

    // go away
    if (loader.length < 1) return;

    loader.remove();
}
