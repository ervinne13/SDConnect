
let vanilla = {};

/**
 * Get the closest matching element up the DOM tree.
 * 
 * @param  {Element} elem     Starting element
 * @param  {String}  selector Selector to match against
 * @return {Boolean|Element}  Returns null if not match found
 */
vanilla.getClosest = function (elem, selector) {

    // Element.matches() polyfill
    if (!Element.prototype.matches) {
        Element.prototype.matches =
                Element.prototype.matchesSelector ||
                Element.prototype.mozMatchesSelector ||
                Element.prototype.msMatchesSelector ||
                Element.prototype.oMatchesSelector ||
                Element.prototype.webkitMatchesSelector ||
                function (s) {
                    var matches = (this.document || this.ownerDocument).querySelectorAll(s),
                            i = matches.length;
                    while (--i >= 0 && matches.item(i) !== this) {
                    }
                    return i > -1;
                };
    }

    // Get closest match
    for (; elem && elem !== document; elem = elem.parentNode) {
        if (elem.matches(selector))
            return elem;
    }

    return null;

};

vanilla.isObjectEmpty = function (obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key))
            return false;
    }
    return true;
};