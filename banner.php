<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
        }

        .banner {
            width: 300px;
            height: 250px;
            background-color: #E2DCC8;
            padding: 5px;
        }

        #name,
        #email,
        #mobile,
        #division {
            background: rgba(255, 255, 255, .1);
            border: none;
            border-radius: 4px;
            font-size: 15px;
            margin: 0;
            outline: 0;
            padding: 5px;
            width: 100%;
            box-sizing: border-box;
            background-color: #e8eeef;
            color: black;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.03) inset;
            margin-bottom: 6px;
        }

        fieldset {
            border: 1px solid #495C83;
        }

        .error {
            outline: 1px solid red !important;
        }

        legend {
            font-size: large;
            font-weight: 800;
            color: #495C83;
        }

        input[type="submit"] {
            position: relative;
            display: block;
            color: whitesmoke;
            margin: 0 auto;
            background: tomato;
            font-size: 16px;
            text-align: center;
            width: 100%;
            border: 1px solid whitesmoke;
            border-radius: 5px;
            padding: 5px;
        }

        #division-label {
            color: #495C83;
        }

        .disabled {
            background-color: grey !important;
            pointer-events: none;
        }

        .enabled {
            pointer-events: stroke;
        }

        .container {
            margin: auto;
        }

        #errorCheck{
            color: red;
        }
    </style>
</head>

<body>
    <div class="banner">
        <form action="formSubmit.php" method="post" id="form">
            <fieldset>
                <legend>User Information</legend>
                <input type=" text" id="name" name="name" required placeholder="Your Name *" onkeyup="checkName()"><br>
                <input type="email" id="email" name="email" required placeholder="Your Email *"><br>
                <input type="number" id="mobile" name="mobile" placeholder="Mobile Number *" onkeyup="checkMobileNumber()" required><br>
                <small id="errorCheck"><br></small>
                <label for="division" id="division-label">Division:</label>
                <select name="division" id="division">
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chattogram">Chattogram</option>
                    <option value="Khulna">Khulna</option>
                    <option value="Barishal">Barishal</option>
                    <option value="Rajshahi">Rajshahi</option>
                    <option value="Rangpur">Rangpur</option>
                    <option value="Mymensingh ">Mymensingh </option>
                    <option value="Sylhet">Sylhet</option>
                </select>
                <br>
                
                <input type="submit" value="Submit" id="submitBtn" name="submit" class="disabled">
            </fieldset>
        </form>
    </div>
    <script>
        function checkingMobile(mobileNum) {
            var xhttp;
            if (mobileNum == "") {
                return;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
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
            xhttp.open("GET", "checkMobileNumber.php?q=" + mobileNum, true);
            xhttp.send();
        }

        function checkMobileNumber() {
            var mobileNum = document.getElementById('mobile').value;
            var mobilePattern = /^(?:\+88|88)?(01[3-9]\d{8})$/;
            
            if (mobileNum.match(mobilePattern)) {
                checkingMobile(mobileNum);
                return true;
            } else {
                document.getElementById("errorCheck").innerHTML = "<br>";
                document.getElementById('mobile').classList.add("error");
                document.getElementById('submitBtn').classList.add("disabled");
                document.getElementById('submitBtn').classList.remove("enabled");
                return false;
            }

        }

        function checkName() {
            var nameLength = document.getElementById('name').value.length;
            if (nameLength == 0) {
                document.getElementById('name').classList.add("error");
                return false;
            } else {
                document.getElementById('name').classList.remove("error");
                return true;
            }
        }
    </script>
</body>

</html>