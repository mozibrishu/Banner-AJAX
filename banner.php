<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner</title>
    <style>
        *{
            box-sizing: border-box;
        }
        .banner{
            width: 300px;
            height: 250px;
            background-color: tomato;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="banner">
        <form action="formSubmit.php" method="post">
            <label for="name">Naame:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="mobile">Mobile No.</label><br>
            <input type="number" id="mobile" name="mobile" maxlength="14"><br>
<br>
            <label for="division">Choose a division:</label>
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
        </form>
    </div>
    <?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('information.sqlite');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }
?>


</body>

</html>