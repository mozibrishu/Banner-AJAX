<?php header('Access-Control-Allow-Origin: *'); ?>
<?php

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
      echo 'success';
      exit();
   }
   $db->close();
} else{
  echo 'used';
}
