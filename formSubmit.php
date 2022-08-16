<?php

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$division = $_POST['division'];


echo $name."<br>";

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

$sql =<<<EOF
      CREATE TABLE if not exists peoplesInfo
      (NAME       TEXT    NOT NULL,
        EMAIL CHAR(50)     NOT NULL,
      MOBILE CHAR(15) NOT NULL,
      DIVISION CHAR(20) NOT NULL);
EOF;

$ret = $db->exec($sql);
if(!$ret){
  echo $db->lastErrorMsg();
}
$sql =<<<EOF
      INSERT INTO peoplesInfo (NAME,EMAIL,MOBILE,DIVISION)
      VALUES ('Maxsu', 'adfdas@gmail', '0129212331', 'Dhaka' );
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Yes, Some Records has Inserted successfully<br/>\n";
   }
   $db->close();
?>