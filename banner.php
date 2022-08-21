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

        .disabled{
            background-color: grey !important;
            pointer-events: none;
        }
        .enabled{
            pointer-events: stroke;
        }

        .container {
            margin: auto;
        }
    </style>
</head>

<body>
<?php
$htmlCode = '<div class="banner">
<form action="" method="post" id="form">
<fieldset>
<legend>User Information</legend>
    <input type=" text" id="name" name="name" required placeholder="Your Name *" onkeyup="checkName()" ><br>
    <input type="email" id="email" name="email" required placeholder="Your Email *"><br>
    <input type="number" id="mobile" name="mobile" placeholder="Mobile Number *" onkeyup="checkMobileNumber()" required><br>

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
    <input type="submit" value="Submit" id="submitBtn" name="submit" class="disabled">
</fieldset>
</form>

</div>';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $division = $_POST['division'];
    
    
    class SQLiteDB extends SQLite3
    {
      function __construct()
      {
         $this->open('information.sqlite');
      }
    }
    
    $db = new SQLiteDB();
    if(!$db){
      echo $db->lastErrorMsg();
    }
    
    $sql ="CREATE TABLE if not exists peoplesInfo (NAME TEXT NOT NULL, EMAIL CHAR(50) NOT NULL, MOBILE CHAR(15) NOT NULL, DIVISION CHAR(20) NOT NULL)";
    
    $ret = $db->exec($sql);
    if(!$ret){
      echo $db->lastErrorMsg();
    }
    $ret = $db->query('SELECT * FROM peoplesInfo');
    $uniqueNumber = true;
    while ($row = $ret->fetchArray()) {
      if($mobile == $row['MOBILE']){
        $uniqueNumber = false;
      }
    }
    
    if($uniqueNumber){
      $sql ="INSERT INTO peoplesInfo (NAME,EMAIL,MOBILE,DIVISION) VALUES ('$name','$email', '$mobile', '$division')";
    
       $ret = $db->exec($sql);
       if(!$ret){
          echo $db->lastErrorMsg();
       } else {
        $db->close();
          header("Location: /assignment1/userInfo.php");
          exit();
       }
       $db->close();
    } else{
        echo '<script>alert("Number already used")</script>';
        echo $htmlCode;
        echo '<script>
        document.ger
        </script>';
    }
}else{
    echo $htmlCode;
}
?>
    <script>
        function checkMobileNumber() {
            var mobileNum = document.getElementById('mobile').value;
            var mobilePattern = /^(?:\+88|88)?(01[3-9]\d{8})$/;
            if (mobileNum.match(mobilePattern)) {
                document.getElementById('mobile').classList.remove("error");
                document.getElementById('submitBtn').classList.remove("disabled");
                document.getElementById('submitBtn').classList.add("enabled");
                return true;
            } else {
                document.getElementById('mobile').classList.add("error");
                document.getElementById('submitBtn').classList.add("disabled");
                document.getElementById('submitBtn').classList.remove("enabled");
                return false;
            }
        }
        function checkName(){
            var nameLength = document.getElementById('name').value.length;
            if(nameLength == 0 ){
                document.getElementById('name').classList.add("error");
                return false;
            } else{
                document.getElementById('name').classList.remove("error");
                return true;
            }
        }
        function checkEmail(){
            var email = document.getElementById('email').value;
            var emailPattern = /^(?:\+88|88)?(01[3-9]\d{8})$/;
            if (email.match(emailPattern)) {
                document.getElementById('email').classList.remove("error");
                return true;
            } else {
                document.getElementById('email').classList.add("error");
                return false;
            }
        }
    </script>
</body>

</html>