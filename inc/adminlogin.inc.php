<<?php
if (isset($_POST["submit"])) {

  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputLogin($username, $pwd) !== false) {
    header("location: ../adminlogin.php?error=emptyinput");
    exit();
  }
  adminloginUser($conn, $username, $pwd);
}
else {
  header("location: ../adminlogin.php");
  exit();
}
 ?>
