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
            background-color: #f4f7f8;
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


        .container {
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="banner">
        <fieldset>
            <legend>User Information</legend>
            <form action="formSubmit.php" method="post">
                <input type=" text" id="name" name="name" required placeholder="Your Name *"><br>
                <input type="email" id="email" name="email" required placeholder="Your Email *"><br>
                <input type="number" id="mobile" name="mobile" placeholder="Mobile Number *" onkeyup="checkMobileNumber()"><br>

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
                <br><br>
                <input type="submit" value="Submit">
        </fieldset>
        </form>

    </div>
    <script>
        function checkMobileNumber() {
            var mobileNum = document.getElementById('mobile').value;
            var mobilePattern = /^(?:\+88|88)?(01[3-9]\d{8})$/;
            if (mobileNum.match(mobilePattern)) {
                document.getElementById('mobile').classList.remove("error");
                return true;
            } else {
                document.getElementById('mobile').classList.add("error");
                return false;
            }
        }

        
    </script>
</body>

</html>