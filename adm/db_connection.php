<?php
$servername = "sql313.infinityfree.com";
$username = "if0_35243878";
$password = "wFnvuxqXo6656";
$dbname = "if0_35243878_Eimpro";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

