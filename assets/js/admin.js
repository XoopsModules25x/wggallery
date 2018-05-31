// method definitions
var toggleCheckbox,
    find_parent;
 
/**
 * Method toggles checkboxes to initiating checkbox.
 * @param {HTMLElement} btn Clicked checkbox (must be inside DIV).
 */
toggleCheckbox = function (btn) {
    var tbl = find_parent('DIV', btn),        // parent table
        el = tbl.getElementsByTagName('input'), // input elements 
        i;                                      // loop variable
    // loop through all collected input elements in table
    for (i = 0; i < el.length; i++) {
        // if input element is checkbox
        el[i].checked = btn.checked;
    }
    
};
 
/**
 * Method returns a reference of the required parent element.
 * @param {String} tag_name Tag name of parent element.
 * @param {HTMLElement} el Start position to search.
 * @return {HTMLElement} Returns reference of the found parent element.
 */
find_parent = function (tag_name, el) {
    // loop up until parent element is found
    while (el && el.nodeName !== tag_name) {
        el = el.parentNode;
    }
    // return found element
    return el;
};




function wgshowImgSelected(imgId, selectId, imgDir, extra, xoopsUrl) {
    if (xoopsUrl == null) {
        xoopsUrl = "./";
    }
    imgDom = xoopsGetElementById(imgId);
    selectDom = xoopsGetElementById(selectId);
    if (selectDom.options[selectDom.selectedIndex].text != "") {
        imgDom.src = xoopsUrl + "/" + imgDir + "/" + selectDom.options[selectDom.selectedIndex].value + extra;
    } else {
        imgDom.src = xoopsUrl + "/images/blank.gif";
    }
}

