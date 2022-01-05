<?php
if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputDeleteuser($username, $pwd) !== false) {
    header("location: ../adminpanel/sunaikintivartotoja.php?error=emptyinput");
    exit();
  }

  sunaikintiVartotoja ($conn, $username);
}
  else {
    header("location: ../adminpanel/sunaikintivartotoja.php");
    exit();
  }
 ?>
