/**
 * Method toggles checkboxes to initiating checkbox.
 * @param {HTMLElement} element Clicked checkbox
 */
function toggleCheckboxGroupPerm (element) {
    var toggle_checked = false; 
    el = document.getElementById('all_'+element+'1'); 
    toggle_checked = el.checked;

    for (var i = 1; i < 10; i++) {
        el = document.getElementById(''+element+i);
        if ( el !== null ) { el.checked = toggle_checked;}
    }
};

function wgshowImgSelected(imgId, selectId, imgDir, extra, xoopsUrl) {
    if (xoopsUrl == null) {
        xoopsUrl = "./";
    }
    imgDom = xoopsGetElementById(imgId);
    selectDom = xoopsGetElementById(selectId);
    if (selectDom.options[selectDom.selectedIndex].text !== "") {
        imgDom.src = xoopsUrl + "/" + imgDir + "/" + selectDom.options[selectDom.selectedIndex].value + extra;
    } else {
        imgDom.src = xoopsUrl + "/images/blank.gif";
    }
    document.getElementById("alb_imgcat1").checked = true;
}

function wgshowAlbumImageSelect(element) {
    // alert(element.value);
    $("#alb_image").attr('disabled', 'disabled');
    $("#alb_imgid").attr('disabled', 'disabled');
    $("#myModalImagePicker-btn").hide();
    $("#attachedfile").attr('disabled', 'disabled');
    $("#alb_resize1").attr('disabled', 'disabled');
    $("#alb_resize2").attr('disabled', 'disabled');
    $("#alb_resize3").attr('disabled', 'disabled');
    
    if (element.value == 1) {
        $("#alb_imgid").removeAttr('disabled');
        $("#myModalImagePicker-btn").show();
    }
    if (element.value == 2) {
        $("#alb_image").removeAttr('disabled');
        $("#alb_image").val("blank.gif").change();
        $("#attachedfile").removeAttr('disabled');
        $("#alb_resize1").removeAttr('disabled');
        $("#alb_resize2").removeAttr('disabled');
        $("#alb_resize3").removeAttr('disabled');
    }
}
function wgshowAlbumImageSelect___OLD___(imgId, selectId, imgDir, extra, xoopsUrl) {
    if (xoopsUrl == null) {
        xoopsUrl = "./";
    }
    imgDom = xoopsGetElementById(imgId);
    selectDom = xoopsGetElementById(selectId);
    if (selectDom.options[selectDom.selectedIndex].value != "") {
        imgDom.src = xoopsUrl + "/" + imgDir + "/" + selectDom.options[selectDom.selectedIndex].value + extra;
    } else {
        imgDom.src = xoopsUrl + "/images/blank.gif";
    }
    document.getElementById("alb_imgcat2").checked = true;
}
