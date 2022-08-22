//Mobile Number Pattern Check
function checkMobileNumber() {
    var mobileNum = document.getElementById('mobile').value;
    var mobilePattern = /^(?:\+88|88)?(01[3-9]\d{8})$/;

    if (mobileNum.match(mobilePattern)) {
        checkingMobile(mobileNum);
        return true;
    } else {
        document.getElementById("errorCheck").innerHTML = "*Mobile Number is not valid<br>";
        document.getElementById('mobile').classList.add("error");
        document.getElementById('submitBtn').classList.add("disabled");
        document.getElementById('submitBtn').classList.remove("enabled");
        return false;
    }
}
// Duplication Check
function checkingMobile(mobileNum) {
    var xhttp;
    if (mobileNum == "") {
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if ('used' == this.responseText) {
                document.getElementById("errorCheck").innerHTML = "*Mobile Number is Already used<br>";
                document.getElementById('mobile').classList.add("error");
                document.getElementById('submitBtn').classList.add("disabled");
                document.getElementById('submitBtn').classList.remove("enabled");
            } else {
                document.getElementById("errorCheck").innerHTML = "<br>";
                document.getElementById('mobile').classList.remove("error");
                document.getElementById('submitBtn').classList.remove("disabled");
                document.getElementById('submitBtn').classList.add("enabled");
            }

        }
    };
    xhttp.open("GET", "http://localhost/assignment1/checkMobileNumber.php?q=" + mobileNum, true);
    xhttp.send();
}
// Email
function checkEmail() {
    var emailText = document.getElementById('email').value;
    var emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{1,8}$/;

    if (emailText.match(emailPattern)) {
        document.getElementById("errorCheck").innerHTML = "<br>";
        document.getElementById('email').classList.remove("error");
        return true;
    } else {
        document.getElementById("errorCheck").innerHTML = "*Email Address Not valid. [some@thing.some]<br>";
        document.getElementById('email').classList.add("error");
        return false;
    }
}
// Name
function checkName() {
    var nameLength = document.getElementById('name').value.length;
    if (nameLength == 0) {
        document.getElementById('name').classList.add("error");
        document.getElementById("errorCheck").innerHTML = "*Name is not valid<br>";
        return false;
    } else {
        document.getElementById('name').classList.remove("error");
        document.getElementById("errorCheck").innerHTML = "<br>";
        return true;
    }
}

// Submit
function submitOperation() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var mobileNum = document.getElementById("mobile").value;
    var division = document.getElementById("division").value;
    var errorInfo = '';
    if (!(checkName())) {
        errorInfo = '*Name is not valid';
    }else if(!(checkEmail())){
        errorInfo = "*Email is not Valid"
    }else{
        submitForm(name, email, mobileNum, division);
    }
}

function submitForm(name, email, mobileNum, division) {
    var xhttp;
    if (mobileNum == "" || email == "" || name == "" || division == "") {
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if ('success' == this.responseText) {
                document.getElementById("banner").innerHTML = "<h3 id='successfullyEntered'>Successfully Inserted</h3>";
            } else {
                document.getElementById("banner").innerHTML = "<p>" + this.responseText + "</p>";
            }
        }
    };
    var submitLink = 'http://localhost/assignment1/formSubmit.php?name=' + name + '&email=' + email + '&mobile=' + mobileNum + '&division=' + division;
    xhttp.open("GET", submitLink, true);
    xhttp.send();
}