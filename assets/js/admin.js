function wgshowImgSelected(imgId, selectId, imgDir, extra, xoopsUrl) {
    if (xoopsUrl == null) {
        xoopsUrl = "./";
    }
    imgDom = xoopsGetElementById(imgId);
    selectDom = xoopsGetElementById(selectId);
    if (selectDom.options[selectDom.selectedIndex].text != "") {
        imgDom.src = xoopsUrl + "/" + imgDir + "/" + selectDom.options[selectDom.selectedIndex].text + extra;
    } else {
        imgDom.src = xoopsUrl + "/images/blank.gif";
    }
}
