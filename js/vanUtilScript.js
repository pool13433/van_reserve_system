function find_duplicates(arr) {
    var len = arr.length,
            out = [],
            counts = {};

    for (var i = 0; i < len; i++) {
        var item = arr[i];
        counts[item] = counts[item] >= 1 ? counts[item] + 1 : 1;
    }

    for (var item in counts) {
        if (counts[item] > 1)
            out.push(item);
    }

    return out;
    /*
     * Example :: find_duplicates(['one',2,3,4,4,4,5,6,7,7,7,'pig','one']); // -> ['one',4,7] in no particular order.   
     */
}

// #################### function check file ###########
function CheckExtension(file) {
    var validFilesTypes = ["jpg", "png", "gif"];
    /*global document: false */
    var filePath = file.value;
    var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
    var isValidFile = false;
    for (var i = 0; i < validFilesTypes.length; i++) {
        if (ext == validFilesTypes[i]) {
            isValidFile = true;
            break;
        }
    }

    if (!isValidFile) {
        file.value = null;
        alert("กรุณาอัพโหลดไฟล์ เป็นชนิด " + validFilesTypes.join(", ") + " เท่านั้น \n\n ท่านกำลังอัพโหลดไฟล์  ชนิด:" + ext + " อยู่ \n\n กรุณาตรวจสอบ");
    }

    return isValidFile;
}
function CheckFileSize(file) {
    var validFileSize = 2 * 1024 * 1024;
    /*global document: false */
    var fileSize = file.files[0].size;
    var isValidFile = false;
    if (fileSize !== 0 && fileSize <= validFileSize) {
        isValidFile = true;
    } else {
        file.value = null;
        alert("กรุณาอัพโหลดไฟล์ที่มีขนาดไม่เกิน 3 MB.");
    }
    return isValidFile;
}
function CheckFile(file) {
    var isValidFile = CheckExtension(file);
    if (isValidFile)
        isValidFile = CheckFileSize(file);
    return isValidFile;
}
// #################### function check file ###########


function popupWindown(url, percent) {
    /*$('.' + elementClass).popupWindow({
     windowURL: url, // 'http://code.google.com/p/swip/',
     windowName: name, // 'swip',
     centerBrowser: 1,
     height: 500,
     width: 800,
     top: 50,
     left: 50
     });*/
    var w = 630, h = 440; // default sizes
    if (window.screen) {
        w = window.screen.availWidth * percent / 100;
        h = window.screen.availHeight * percent / 100;
    }

    window.open(url, 'windowName', 'width=' + w + ',height=' + h);
//    var newwindow = window.open($(element).attr('href'), '', 'height=200,width=150');
//    if (window.focus) {
//        newwindow.focus();
//    }
    return false;
}
function popupWindownGet(url, formId, percent) {
    var w = 630, h = 440; // default sizes
    if (window.screen) {
        w = window.screen.availWidth * percent / 100;
        h = window.screen.availHeight * percent / 100;
    }

    window.open(url, 'windowName', 'width=' + w + ',height=' + h);
    $('#' + formId).submit();
    return false;
}
function OpenWindow(params, width, height, name) {
    var screenLeft = 0, screenTop = 0;
    if (!name)
        name = 'MyWindow';
    if (!width)
        width = 600;
    if (!height)
        height = 600;
    var defaultParams = {}

    if (typeof window.screenLeft !== 'undefined') {
        screenLeft = window.screenLeft;
        screenTop = window.screenTop;
    } else if (typeof window.screenX !== 'undefined') {
        screenLeft = window.screenX;
        screenTop = window.screenY;
    }

    var features_dict = {
        toolbar: 'no',
        location: 'no',
        directories: 'no',
        left: screenLeft + ($(window).width() - width) / 2,
        top: screenTop + ($(window).height() - height) / 2,
        status: 'yes',
        menubar: 'no',
        scrollbars: 'yes',
        resizable: 'no',
        width: width,
        height: height
    };
    var features_arr = [];
    for (var k in features_dict) {
        features_arr.push(k + '=' + features_dict[k]);
    }
    features_str = features_arr.join(',')

    var qs = '?' + $.param($.extend({}, defaultParams, params));
    var win = window.open(qs, name, features_str);
    win.focus();
    return false;
}

function print_properties_in_object(object) {
    var output = '';
    for (var property in object) {
        output += property + ': ' + object[property] + '; ';
    }
    return output;
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function checkCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}
function setAccordion(element) { // element = this
    var tagA = $(element).parents('div.panel-collapse');
    var tagId = $(tagA).attr('id');
    setCookie('accordion', tagId, 365);
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) == 0)
            return c.substring(name.length, c.length);
    }
    return "";
}
function redirectDelay(url, timer) {
    setTimeout(function () {
        window.location.href = url; //will redirect to your blog page (an ex: blog.html)
    }, (timer * 1000)); //will call the function after 2 secs.
}
function reloadDelay(timer) {
    setTimeout(function () {
        window.location.reload(); //will redirect to your blog page (an ex: blog.html)
    }, (timer * 1000)); //will call the function after 2 secs.
}
function goUrl(url) {
    window.location.href = url; //will redirect to your blog page (an ex: blog.html)
}
function arrayObjectToJsonString(arrayObject) {
    var jsonstring = JSON.stringify(arrayObject);
    return jsonstring;
}
function jsonStringToJsonObject(myJSONtext) {
    var myObject = eval('(' + myJSONtext + ')');
    return myObject;
}