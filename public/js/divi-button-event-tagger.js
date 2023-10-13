function addDivibuttonevents() {
    let elts = document.querySelectorAll(".et_pb_button");
    if (elts === undefined || elts === "") return;
    let eltsArr = Array.from(elts);
    let docTitle = document.title;
    eltsArr.map((elt) => {
        try {
            let btnTxt = elt.innerText;
            elt.setAttribute("data-vars-ga-category", "button"); // change to suit event name
            elt.setAttribute("data-vars-ga-action", "click"); // change to suit action
            elt.setAttribute("data-vars-ga-label", docTitle + ' - ' + btnTxt); // page title and button text
        } catch (e) {
            console.log("Divi Button Event Tagger did not fire correctly" + php_vars.querySelectorAll);
        }
    });
    // removes rel='nofollow' from buttons for SEO
      elts.forEach(elt => {
        if (elt.hasAttribute('rel')) {
        const relAttribute = elt.getAttribute('rel');

        if (relAttribute.includes('nofollow')) {
            elt.removeAttribute('rel');
        }
        }
    });
};