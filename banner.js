//Mobile Number Pattern Check
function checkMobileNumber() {
    var mobileNum = getValue('mobile');
    var mobilePattern = /^(?:\+88|88)?(01[3-9]\d{8})$/;

    if (mobileNum.match(mobilePattern)) {
        setInnerHtml('errorCheck', "<br>");
        addClass('submitBtn', 'enabled');
        removeClass('submitBtn', 'disabled');
        addClass('mobile', 'valid');
        removeClass('mobile', 'error');
        return true;
    } else {
        setInnerHtml('errorCheck', "*Mobile Number is not valid<br>");
        addClass('mobile', 'error');
        removeClass('mobile', 'valid');
        addClass('submitBtn', 'disabled');
        removeClass('submitBtn', 'enabled');
        return false;
    }
}
// Email
function checkEmail() {
    var emailText = document.getElementById('email').value;
    var emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{1,8}$/;

    if (emailText.match(emailPattern)) {
        setInnerHtml('errorCheck', "<br>");
        removeClass('email', 'error');
        addClass('email', 'valid');
        return true;
    } else {
        setInnerHtml('errorCheck', "*Email Address Not valid. [some@thing.some]<br>");
        addClass('email', 'error');
        removeClass('email', 'valid');
        return false;
    }
}
// Name
function checkName() {
    var nameLength = document.getElementById('name').value.length;
    if (nameLength == 0) {
        addClass('name', 'error');
        removeClass('name', 'valid');
        setInnerHtml('errorCheck', "*Name is not valid<br>");
        return false;
    } else {
        removeClass('name', 'error');
        addClass('name', 'valid');
        setInnerHtml('errorCheck', "<br>");
        return true;
    }
}

// Submit
function submitOperation() {
    var name = getValue('name');
    var email = getValue('email');
    var mobileNum = getValue('mobile');
    var division = getValue('division');
    var errorInfo;

    if (!(checkName())) {
        errorInfo = '*Name is not valid';
    } else if (!(checkEmail())) {
        errorInfo = "*Email is not Valid"
    } else {
        submitForm(name, email, mobileNum.slice(-11), division);
    }
}

function submitForm(name, email, mobileNum, division) {
    var xhttp;
    if (mobileNum == "" || email == "" || name == "" || division == "") {
        return;
    }
    const formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("mobile", mobileNum);
    formData.append("division", division);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if ('success' == this.responseText) {
                setInnerHtml('banner', "<h3 id='submissionSuccess'>Successfully Inserted</h3>");
            } else if ('used' == this.responseText) { 
                setInnerHtml('errorCheck', "*Mobile Number is Already used<br>");
                addClass('mobile','error');
                removeClass('mobile', 'valid');
             }
            else {
                document.getElementById("banner").innerHTML = "<p>" + this.responseText + "</p>";
            }
        }
    };

    xhttp.open("POST", 'http://localhost/assignment1/formSubmit.php', true);
    xhttp.send(formData);
}

// Add remove Get set
function addClass(elementId, className) {
    document.getElementById(elementId).classList.add(className);
}
function removeClass(elementId, className) {
    document.getElementById(elementId).classList.remove(className);
}

function getValue(elementId) {
    return document.getElementById(elementId).value;
}
function setInnerHtml(elementId, text) {
    document.getElementById(elementId).innerHTML = text;
}