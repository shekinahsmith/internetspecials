/**
 * Scrolls to specified element
 * @param  {string} elem
 * @param  {integer} speed
 * @example
 * scrollToElement('.section--packages', 400);
 */
function scrollToElement(elem, speed) {

    var scrollSpeed = speed || 800;

    $('html, body').stop().animate({

        scrollTop: $(elem).offset().top - 70 // accomodating for nav

    }, scrollSpeed);
}