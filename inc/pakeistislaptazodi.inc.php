<?php
if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $isadmin = $_POST["isadmin"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputDeleteuser($username, $pwd) !== false) {
    header("location: ../adminpanel/pakeistislaptazodi.php?error=emptyinput");
    exit();
  }

  pakeistiSlaptazodi ($conn, $username, $pwd, $isadmin);
}
  else {
    header("location: ../adminpanel/pakeistislaptazodi.php");
    exit();
  }
 ?>
