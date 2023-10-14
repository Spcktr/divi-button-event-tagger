jQuery(document).ready(function($) {
    function removeNofollow() {
       let elts = document.querySelectorAll(".et_pb_button");
        elts.forEach((elt) => {
            if (elt.hasAttribute('rel')) {
                const relAttribute = elt.getAttribute('rel');
                if (relAttribute.includes('nofollow')) {
                    elt.removeAttribute('rel');
                }
            }
        });
    }

    // Call the function when the page is fully loaded
    $(window).on('load', function() {
        removeNofollow();
    });
});
