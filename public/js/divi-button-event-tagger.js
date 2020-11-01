function addDivibuttonevents() {
    let elts = document.querySelectorAll(".et_pb_button");
    if (elts === undefined || elts === "") return;
    let eltsArr = Array.from(elts);
    let docTitle = document.title;
    eltsArr.map((elt) => {
        try {
            let btnTxt = elt.innerText;
            elt.setAttribute("data-vars-ga-category", "button");
            elt.setAttribute("data-vars-ga-action", "click");
            elt.setAttribute("data-vars-ga-label", docTitle + ' - ' + btnTxt);
        } catch (e) {
            console.log("Divi Button Event Tagger did not fire correctly" + php_vars.querySelectorAll);
        }
    });
})();
